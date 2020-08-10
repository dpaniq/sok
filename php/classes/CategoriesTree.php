<?php

namespace App;

use Database;

include './config/db.php';

class CategoriesTree
{

    function __construct()
    {
        $this->conn = \Database::connect();
        $this->html = '';
    }

    /** 
     * @return array with categories
     */
    public function getCategories(): array
    {
        $query = Database::getCategories();

        $result = array();
        if ($query->num_rows != 0)
        {
            for ($i = 0; $i < $query->num_rows; $i++)
            {
                $row = $query->fetch_assoc();
                $temp = $row["parent_id"] ? $row["parent_id"] : 0;
                $result[$temp][] = $row;
            }
            return $result;
        }
    }

    /** 
     * @param array arr
     * @param int parent_id
     * @return HTML_DOM_HTML_Object
     * $parent_prefix - current parent 
     * $heading_prefix - current category
     * $collapse_prefix - id for bootstrap collapse or collapse show category's content
     */
    public function generateCategoriesHTMLTree(array $arr, int $parent_id = 0)
    {
        if (empty($arr[$parent_id])) {
            return;
        }

        $parent_prefix = "parent_prefix_{$parent_id}";
        echo "<div id='{$parent_prefix}'>";  // Open Div #1

        for ($i = 0; $i < count($arr[$parent_id]); $i++) {

            $heading_prefix = "heading_prefix_{$i}";
            $collapse_prefix = "collapse_prefix_{$parent_id}_{$i}";

            echo '<div class="card" data-card="' . $collapse_prefix. '">'  // Open Div #2
                .   '<div class="card-header" id="' . $heading_prefix . '">'  // Open Div #3                                           
                .       '<h5 class="mb-0">'
                .           '<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#'. $collapse_prefix .'" aria-expanded="false" aria-controls="'. $collapse_prefix .'">'   
                .               $arr[$parent_id][$i]['name']
                .               '<img class="sub" src="https://image.flaticon.com/icons/svg/32/32195.svg" alt="dropdown" width="10px">'
                .           '</button>'
                .           '<div class="crud-button" data-parent="' . $collapse_prefix. '"data-id="' . $arr[$parent_id][$i]['id']. '">'
                .               '<button class="btn btn-primary">Add</button>'
                .               '<button class="btn btn-warning">Update</button>'
                .               '<button class="btn btn-danger">Delete</button>'
                .           '</div>'
                .       '</h5>';                      
            echo '<div id="'. $collapse_prefix .'" class="collapse" aria-labelledby="'. $heading_prefix .'" data-parent="#'. $parent_prefix .'">'  // Open Div #4 (sub)
                .   '<div class="card-body">'  // Open Div #5 (subs)
                .       '<p>' . $arr[$parent_id][$i]['description'] . '</p><hr/>';
                $this->generateCategoriesHTMLTree($arr, intval($arr[$parent_id][$i]['id']));
            echo '</div>';  // Close Div #5
            echo '</div>';  // Close Div #4
            echo '</div>';  // Close Div #3
            echo '</div>';  // Close Div #2
        }
        echo '</div>';  // Close Div #1
    }
}
