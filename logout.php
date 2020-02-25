<?php
session_start();
session_destroy();
echo'<script>

			setTimeout(function()
			{ 
				window.location = "index.php"; 
			}, 2000);

			</script>';