<?php
namespace library;

/**
 * To NOT hard code searches in test scripts.
 */
class PostQuery
{
    public string $page;

    public array $get;
    public array $post;

	/**
	 * Phrases to look for
	 */
    public array $lookups;

    public function __construct($page="index.php", $get=[], $post=[], $lookups=[])
    {
        $this->page = $page;
        $this->get = $get;
        $this->post = $post;

        $this->lookups = $lookups;
    }
}
