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
 *   - title: The human-readable name of the permission, to be shown on the
 *     permission administration page. This should be wrapped in the t()
 *     function so it can be translated.
 *   - description: (optional) A description of what the permission does. This
 *     should be wrapped in the t() function so it can be translated.
 *   - restrict access: (optional) A boolean which can be set to TRUE to
 *     indicate that site administrators should restrict access to this
 *     permission to trusted users. This should be used for permissions that
 *     have inherent security risks across a variety of potential use cases
 *     (for example, the "administer filters" and "bypass node access"
 *     permissions provided by Drupal core). When set to TRUE, a standard
 *     warning message defined in user_admin_permissions() and output via
 *     theme_user_permission_description() will be associated with the
 *     permission and displayed with it on the permission administration page.
 *     Defaults to FALSE.
 *   - warning: (optional) A translated warning message to display for this
 *     permission on the permission administration page. This warning overrides
 *     the automatic warning generated by 'restrict access' being set to TRUE.
 *     This should rarely be used, since it is important for all permissions to
 *     have a clear, consistent security warning that is the same across the
 *     site. Use the 'description' key instead to provide any information that
 *     is specific to the permission you are defining. 
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