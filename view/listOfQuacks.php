	<?php
		if ( isset( $quacklist ) && !empty( $quacklist ) ){
			echo "<div id='quacks'>";
				foreach( $quacklist as $item )
				{
					echo "<div id='quack'><p id='info'>" . "@" . $item->username . " - " .
					date( 'F j, Y', strtotime( $item->date ) ) . ' at ' . date( 'G:i:s', strtotime( $item->date ) ) . "</p><p id='content'>" .
					preg_replace('/(?<!\S)#([0-9a-zA-Z_]+)/', '<a href="' . __SITE_URL . '/index.php?rt=quacksWithATag&hashtag=$1">#$1</a>', $item->quack) .
					"</p></div>";
				}
			echo "</div>";
		}
	?>
</div>
