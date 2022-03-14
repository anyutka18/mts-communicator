# mts-communicator
Class MTS for opencart library


Just add to catalog/controller/startup/startup.php this line:

// MTS
		$this->registry->set('mts', new Mts\MTSCClient($this->registry));
