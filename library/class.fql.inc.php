<?php
namespace library;

class fql
{
    /**
     * Read the SQL from file and rename the oc_ prefix.
     */
    public function read($sql_filename="")
    {
        $file = __OCUNIT_ROOT__."/sql/".$sql_filename;
        assert(file_exists($file));
       
        $sql = file_get_contents($file);
        $sql = str_replace("oc_", DB_PREFIX, $sql);

        return $sql;
    }
}