<?php
    include '../config/db.php'; 
    $request = (object)json_decode(file_get_contents('php://input'), true);

    if ($request->method === 'ADD')
    {
        if (!$request->id) {
            Database::addCategory($request->title, $request->description);
        } else {
            Database::addCategoryWithParentId($request->title, $request->description, $request->id);
        }
    }
    elseif ($request->method === 'UPDATE')
    {
        Database::updateCategoryById($request->title, $request->description, intval($request->id));
    }
    elseif ($request->method === 'DELETE')
    {
        Database::deleteCategoryById($request->id);
        Database::deleteAllSubCategories($request->id);
    }
?>