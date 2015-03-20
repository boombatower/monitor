<?php
	function getData($server) {
		$ssh = new Net_SSH2($server);
		$key = new Crypt_RSA();
		$key->loadKey(file_get_contents('./private.key'));
		if (!$ssh->login('root', $key)) {
			return 'Login Failed or Key does not exist.';
		}
		else {
			$chunks = explode("\n", $ssh->exec('ls /dev/shm/worker-data'));
			array_pop($chunks);
			
			$total_files = count($chunks);
			$cores = $ssh->exec('nproc');
			
			if ($total_files == $cores + 7) {
				array_unshift($chunks, "Working");
			}
			elseif ($total_files < $cores + 7 && $total_files + 7 > 7) {
				array_unshift($chunks, "Cooling Down");
			}
			elseif ($total_files < 7 && $total_files > 0) {
				array_unshift($chunks, "Communicating with RD");
			}
			else {
				array_unshift($chunks, "Idle");
			}
			
			array_unshift($chunks, $cores);
			return $chunks;
		}
	}
?>