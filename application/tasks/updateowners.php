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
		Owner::getOldest($this->database)->update();
	}
}

?>
