<?php
/**
 * This Template is used for managing display settings.
 *
 * @author  Tech Banker
 * @package captcha-bank/views/captcha-settings
 * @version 3.0.0
 */
if (!defined("ABSPATH")) {
   exit;
} //exit if accessed directly
if (!is_user_logged_in()) {
   return;
} else {
   $access_granted = false;
   foreach ($user_role_permission as $permission) {
      if (current_user_can($permission)) {
         $access_granted = true;
         break;
      }
   }
   if (!$access_granted) {
      return;
   } elseif (captcha_settings_captcha_bank == "1") {
      $display_setting = explode(",", isset($display_settings_unserialized_data["settings"]) ? esc_attr($display_settings_unserialized_data["settings"]) : "");
      if (class_exists("WooCommerce")) {
         $version = captcha_bank_plugin_get_version("woocommerce/woocommerce.php");
      }
      $captcha_type_display = wp_create_nonce("captcha_bank_settings");
      ?>
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li>
               <i class="icon-custom-home"></i>
               <a href="admin.php?page=captcha_bank">
                  <?php echo $cpb_captcha_bank_title; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <a href="admin.php?page=captcha_bank">
                  <?php echo $cpb_captcha_settings_label; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpb_display_settings_title; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-paper-clip"></i>
                     <?php echo $cpb_display_settings_title; ?>
                  </div>
                  <a href="http://beta.tech-banker.com/products/captcha-bank/" target="_blank" class="premium-editions"><?php echo $cpb_upgrade_to ?></a>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_display_settings">
                     <div class="form-body">
                        <?php
                        if ($cpb_message_translate_help != "") {
                           ?>
                           <div class="note note-danger">
                              <h4 class="block">
                                 <?php echo $cpb_important_disclaimer; ?>
                              </h4>
                              <strong><?php echo $cpb_message_translate_help; ?> <a href="javascript:void(0);" data-popup-open="ux_open_popup_translator" class="custom_links" onclick="show_pop_up_captcha_bank();"><?php echo $cpb_message_translate_here; ?></a></strong>
                           </div>
                           <?php
                        }
                        ?>
                        <label class="control-label">
                           <?php echo $cpb_display_settings_enable_captcha_for ?> :
                           <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_display_settings_enable_captcha_tooltip; ?>" data-placement="right"></i>
                           <span class="required" aria-required="true">*</span>
                        </label>
                        <table class="table table-striped table-bordered table-margin-top" id="ux_tbl_display_settings">
                           <thead>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_login_form" value="1" <?php echo isset($display_setting[0]) && $display_setting[0] == 1 ? "checked=checked" : "" ?>>
                                    <?php echo $cpb_display_settings_login_form; ?>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_bbpress_login" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_bbpress_login; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_registration_form" value="1" <?php echo isset($display_setting[2]) && $display_setting[2] == 1 ? "checked=checked" : "" ?>>
                                    <?php echo $cpb_display_settings_registration_form; ?>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_bbpress_register" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_bbpress_register; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_password_form" value="1" <?php echo isset($display_setting[4]) && $display_setting[4] == 1 ? "checked=checked" : "" ?>>
                                    <?php echo $cpb_display_settings_reset_password_form; ?>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_bbpress_lost_password" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_bbpress_lost_password; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_comment_form" value="1" <?php echo isset($display_setting[6]) && $display_setting[6] == 1 ? "checked=checked" : "" ?>>
                                    <?php echo $cpb_display_settings_comment_form; ?>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_bbpress_new_topic" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_bbpress_new_topic; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_admin_form" value="1" <?php echo isset($display_setting[8]) && $display_setting[8] == 1 ? "checked=checked" : "" ?>>
                                    <?php echo $cpb_display_settings_admin_comment_form; ?>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_bbpress_reply_topic" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_bbpress_reply_topic; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_hide_captcha_for_user" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_hide_captcha_register_user; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_buddypress_login" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_buddypress_login; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_woocommerce_login" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_woocommerce_login; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_buddypress" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_buddypress; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_woocommerce_register" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_woocommerce_register; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_buddypress_lost_password" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_buddypress_lost_password; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_woocommerce_lost_password" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_woocommerce_lost_password; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_jetpack_form" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_jetpack_form; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_woocommerce_checkout" value="1" disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_woocommerce_checkout; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_wpforo_login" value="1"  disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_wpforo_login; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              <tr>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_contact_form7" value="1"  disabled="disabled">
                                    <?php echo $cpb_display_settings_contact_form7; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                                 <th class="control-label">
                                    <input type="checkbox" name="ux_chk[]" id="ux_chk_captcha_wpforo_register" value="1"  disabled="disabled">
                                    <?php echo $cpb_display_settings_captcha_wpforo_register; ?>
                                    <span class="required" aria-required="true"><?php echo "( " . $cpb_premium_editions_label . " )"; ?></span>
                                 </th>
                              </tr>
                           </thead>
                        </table>
                        <div class="line-separator"></div>
                        <div class="form-actions">
                           <div class="pull-right">
                              <input type="submit" class="btn vivid-green" name="ux_btn_save_changes" id="ux_btn_save_changes" value="<?php echo $cpb_save_changes; ?>">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <?php
   } else {
      ?>
      <div class="page-bar">
         <ul class="page-breadcrumb">
            <li>
               <i class="icon-custom-home"></i>
               <a href="admin.php?page=captcha_bank">
                  <?php echo $cpb_captcha_bank_title; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <a href="admin.php?page=captcha_bank">
                  <?php echo $cpb_captcha_settings_label; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpb_display_settings_title; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-paper-clip"></i>
                     <?php echo $cpb_display_settings_title; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <div class="form-body">
                     <strong><?php echo $cpb_user_access_message; ?></strong>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php
   }
}