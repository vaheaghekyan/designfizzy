<fieldset class="proposal">
	<div class="row">
		<div class="large-12 columns">
			<legend class="project-title">
				<span>Congratulations! </span> You've accepted this project.
				<?php 
				$before = "";
				$after = "";
				$url = get_permalink(intval(get_query_var("hb_project_id")));
				echo html( 'a', array(
					'class' => 'button',
					'href' => $url,
				), $before . "View New Project" . $after );
				?>
			</legend>
		</div>
	</div>
</fieldset>

