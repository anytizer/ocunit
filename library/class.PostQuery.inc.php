<?php
namespace library;

/**
 * To NOT hard code searches in test scripts.
 */
class PostQuery
{
    public $page = null;

    public $get = [];
    public $post = [];

	/**
	 * Phrases to look for
	 */
    public $lookups = [];

    public function __construct($page="index.php", $get=[], $post=[], $lookups=[])
    {
        $this->page = $page;
        $this->get = $get;
        $this->post = $post;

        $this->lookups = $lookups;
    }
}
