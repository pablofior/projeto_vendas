<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 19/05/19
 * Time: 13:06
 */

namespace App\Helpers;


class CreateActionsButtonsHelper
{
    public static function makeButtons($id, $editRoute)
    {
        return '<a class="btn btn-warning btn-xs"
                            title="Editar"
                            href="' . route($editRoute, $id) . '">
                            <i class="fa fa-edit"></i>
                        </a>
        <a class="btn btn-danger btn-xs"
                            title="Deletar"
                            onclick="confirmDelete(' . $id . ')"
                            style="margin-left: 2px;">
                            <i class="fa fa-close"></i>
                            </a>';
    }
}