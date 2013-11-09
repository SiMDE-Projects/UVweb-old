<?php 

namespace Uvweb\UvBundle\Services\FlashbagManager;

class UvwebFlashbagManager
{
	private $session;

	public function __construct(\Symfony\Component\HttpFoundation\Session\Session $session)
    {
        $this->session = $session;
    }

	//Will be used to display informations to the user below the header
	public function addFlashMessage($content = 'Error', $type = 'error')
	{
		$message_to_display = array(
			'type' => $type,
			'content' => $content
		);

		$this->session->getFlashBag()->add('message_to_display', $message_to_display);
	}
}

?>