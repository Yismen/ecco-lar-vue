<?php

function personName($name)
{
    return ucwords(
        trim(
            str_replace(['-', '_'], ' ', $name)
        )
    );
}

/**
 * allows to create a delete button
 * @param  $route    route name where point to
 * @param  $resource the id or slug of the resource to be added to the delete
 * @param  [array] $options  with this array we can override the defaults
 * @return            html form
 */
function deleteForm($route, $resource, $options = null)
{
    $defaults = [
        'btn-type' => 'btn-danger',
        'btn-text' => ' Delete'
    ];

    if ($options) {
        $defaults = array_merge($defaults, $options);
    }

    $form = '<form action="' . route($route, $resource) . '" method="POST" class="" style="">';

    $form .= csrf_field();
    $form .= method_field('DELETE');
    $form .= '<button type="submit" id="" class="btn ' . $defaults['btn-type'] . '" style="" name="deleteBtn">';
    $form .= '<i class="fa fa-btn fa-trash"></i>' . $defaults['btn-text'];
    $form .= '</button>';

    return $form .= '</form>';
}

/**
 * allows to create a delete button link
 * @param  $route    route name where point to
 * @param  $resource the id or slug of the resource to be added to the delete
 * @param  [array] $options  with this array we can override the defaults
 * @return            html form
 */
function deleteFormLink($route, $resource, $options = null)
{
    $defaults = [
        'btn-type' => 'btn-link',
        'btn-text' => ''
    ];

    if ($options) {
        $defaults = array_merge($defaults, $options);
    }

    $form = '<form action="' . route($route, $resource) . '" method="POST" class="" style="display: inline-block;">';

    $form .= csrf_field();
    $form .= method_field('DELETE');
    $form .= '<button type="submit" id="" class="btn ' . $defaults['btn-type'] . '" style="" name="deleteBtn">';
    $form .= '<span class="text-danger">';
    $form .= '<i class="fa fa-btn fa-remove"></i>' . $defaults['btn-text'];
    $form .= '</span>';
    $form .= '</button>';
    return $form .= '</form>';
}
