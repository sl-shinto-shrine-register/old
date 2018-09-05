<?php

/**
 * UpdateOwner class.
 */
class UpdateOwners extends Task {
	
	/**
	 * Run the task.
	 * @return void
	 */
	public function run() {
		// Updates only the oldest owner database record at every request
		$oldestOwner = Owner::getOldest($this->database);
		if (!empty($oldestOwner)) $oldestOwner->update();
	}
}

?>
