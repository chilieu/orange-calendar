
<script>

  $(function() { // document ready

    $('#calendar').fullCalendar({
      schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      theme: true,
      now: '<?=date("Y-m-d")?>',
      selectable: true,
      selectHelper: true,
      editable: true, // enable draggable events
      aspectRatio: 2,
      //scrollTime: '00:00', // undo default 6am scrollTime
      eventLimit: true, // allow "more" link when too many events
      header: {
        left: 'today prev,next',
        center: 'title',
        right: 'timelineDay,timelineThreeDays,agendaWeek,month'
      },
      defaultView: 'agendaWeek',
      views: {
        timelineThreeDays: {
          type: 'timeline',
          duration: { days: 3 }
        }
      },
      // the point if this demo is to demonstrate dayClick...
      /*dayClick: function(date, jsEvent, view, resourceObj) {
        console.log(
          'dayClick',
          date.format(),
          resourceObj ? resourceObj.id : '(no resource)'
        );
      },
      select: function(start, end, jsEvent, view, resource) {
        var title = prompt('Event Title:');
        var eventData;
        if (title) {
          eventData = {
            title: title,
            start: start,
            end: end
          };
          $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
        }
        $('#calendar').fullCalendar('unselect');
      },
      */
      resourceLabelText: 'Rooms',
      resources: [
      <?php foreach($rooms->result() as $r):?>
        { id: 'r<?=$r->id?>', title: "<?=stripslashes($r->room)?>" },
      <?php endforeach;?>
      ],
      events: [
      <?php foreach($events->result() as $e):?>
      <?php
        $tip = date("g:i a", strtotime($e->date_from) ) ."-". date("g:i a", strtotime($e->date_to) ). "-" . $e->event . "<>" . $e->notes;
      ?>
        { id: '<?=$e->id?>', resourceId: 'r<?=$e->room_id?>', start: '<?=date("c", strtotime($e->date_from));?>', end: '<?=date("c", strtotime($e->date_to));?>', title: "<?=$e->event?>", tip: "<?=$tip?>" },
      <?php endforeach;?>
      ],
      /*
      eventMouseover: function(calEvent, jsEvent) {
          var tooltip = '<div class="tooltipevent" style="text-align:center;padding:3px;width:100px;height:100px;background:#efefef;border:1px solid #333;position:absolute;z-index:10001;">' + calEvent.title + '</div>';
          $("body").append(tooltip);
          $(this).mouseover(function(e) {
              $(this).css('z-index', 10000);
              $('.tooltipevent').fadeIn('500');
              $('.tooltipevent').fadeTo('10', 1.9);
          }).mousemove(function(e) {
              $('.tooltipevent').css('top', e.pageY + 10);
              $('.tooltipevent').css('left', e.pageX + 20);
          });
      },*/
      eventMouseout: function(calEvent, jsEvent) {
          $(this).css('z-index', 8);
          $('.tooltipevent').remove();
      }

    });

  });

</script>
    <div id='calendar'></div>