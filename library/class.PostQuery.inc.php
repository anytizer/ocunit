<?php
namespace library;

/**
 * @todo Utilize search options. Do NOT hard code in test scripts.
 */
class PostQuery
{
    public $page = "index.php";

    public $get = [];
    public $post = [];

	/**
	 * Phrases to look for
	 */
    public $lookups = [];

    public function __construct($page="", $get=[], $post=[], $lookups=[])
    {
        $this->page = $page;
        $this->get = $get;
        $this->post = $post;
        $this->lookups = $lookups;
    }
}