<div class="container">
<h3>Event on  <span class="text-primary"><?=date("F j, Y", strtotime($conflict_time['start']) )?> From: <b><?=date("h:i a", strtotime($conflict_time['start']) )?> - <?=date("h:i a", strtotime($conflict_time['end']) )?></b></span> is conflicting with:</h3>
<ul>
<?php foreach( $conflict as $k => $c ):?>
	<li>
		<a href="/leader/index/eventDetail/<?=$c['id']?>/" target="_blank"><b class="text-primary"><?=$c['event']?></b></a>
		<?php if( !empty($c['description']) ):?>
			<blockquote><?=$c['description']?></blockquote>
		<?php endif;?>
	</li>
<?php endforeach;?>
</ul>
</div>
