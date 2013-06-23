<?php
/**
 * @file
 * Hooks provided by the Group module.
 */

/**
 * Define group permissions.
 *
 * This hook can supply permissions that the module defines, so that they
 * can be selected on the group permissions page and used to grant or restrict
 * access to actions the module performs.
 *
 * Permissions are checked using Group::userHasPermission().
 *
 * @return
 * An array whose keys are permission names and whose corresponding values
 * are arrays containing the following key-value pairs:
 * - title: The human-readable name of the permission, to be shown on the
 *   permission administration page. This should be wrapped in the t() function
 *   so it can be translated.
 * - description: (optional) A description of what the permission does. This
 *   should be wrapped in the t() function so it can be translated.
 * - restrict access: (optional) A boolean which can be set to TRUE to indicate
 *   that site administrators should restrict access to this permission to
 *   trusted users. This should be used for permissions that have inherent
 *   security risks across a variety of potential use cases (for example, the
 *   "administer filters" and "bypass node access" permissions provided by
 *   Drupal core). When set to TRUE, a standard warning message defined in
 *   user_admin_permissions() and output via
 *   theme_user_permission_description() will be associated with the permission
 *   and displayed with it on the permission administration page. Defaults to
 *   FALSE.
 * - warning: (optional) A translated warning message to display for this
 *   permission on the permission administration page. This warning overrides
 *   the automatic warning generated by 'restrict access' being set to TRUE.
 *   This should rarely be used, since it is important for all permissions to
 *   have a clear, consistent security warning that is the same across the
 *   site. Use the 'description' key instead to provide any information that
 *   is specific to the permission you are defining.
 *
 * @see hook_permission()
 */
function hook_group_permission() {
  return array(
    'contact group members' => array(
      'title' => t('Contact group members'),
      'description' => t('Send group members a private message.'),
    ),
  );
}

/**
 * Add mass group operations.
 *
 * This hook enables modules to inject custom operations into the mass
 * operations dropdown found at admin/group, by associating a callback
 * function with the operation, which is called when the form is submitted.
 *
 * The callback function receives one initial argument, which is an array of
 * the selected groups. If it is a form callback, it receives the form and
 * form state as well.
 *
 * @return array
 *   An array of operations. Each operation is an associative array that may
 *   contain the following key-value pairs:
 *   - label: (required) The label for the operation, displayed in the dropdown
 *     menu.
 *   - callback: (required) The function to call for the operation.
 *   - callback arguments: (optional) An array of additional arguments to pass
 *     to the callback function.
 *   - form callback: (optional) Whether the callback is a form builder. Set
 *     to TRUE to have the callback build a form such as a confirmation form.
 *     This form will then replace the group overview form, see the 'delete'
 *     operation for an example.
 */
function hook_node_operations() {
  // Acts upon selected groups but shows overview form right after.
  $operations['close'] = array(
    'label' => t('Close selected groups'),
    'callback' => 'mymodule_open_or_close_groups',
    'callback arguments' => array('close'),
  );

  // Acts upon selected groups but shows overview form right after.
  $operations['open'] = array(
    'label' => t('Open selected groups'),
    'callback' => 'mymodule_open_or_close_groups',
    'callback arguments' => array('open'),
  );

  // Shows a different form when this operation is selected.
  $operations['delete'] = array(
    'label' => t('Delete selected groups'),
    'callback' => 'group_multiple_delete_confirm',
    'form callback' => TRUE,
  );

  return $operations;
}
