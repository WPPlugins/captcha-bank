<?php
/**
 * This Template is used for managing IP Ranges.
 *
 * @author  Tech Banker
 * @package captcha-bank/views/advance-security
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
   } elseif (security_settings_captcha_bank == "1") {
      $captcha_manage_ip_range = wp_create_nonce("captcha_manage_ip_ranges");
      $advance_security_manage_ip_ranges_delete = wp_create_nonce("captcha_manage_ip_ranges_delete");
      $timestamp = time();
      $start_date = $timestamp - 2592000;
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
               <a href="admin.php?page=captcha_bank_blockage_settings">
                  <?php echo $cpb_security_settings_label; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpb_block_unblock_ip_range_label; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-wrench"></i>
                     <?php echo $cpb_block_unblock_ip_range_label; ?>
                  </div>
                  <a href="http://beta.tech-banker.com/products/captcha-bank/" target="_blank" class="premium-editions"><?php echo $cpb_upgrade_to ?></a>
               </div>
               <div class="portlet-body form">
                  <form id="ux_frm_manage_ip_ranges">
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
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpb_manage_ip_ranges_start_range_title; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_manage_ip_ranges_start_range_tooltip; ?>" data-placement="right" ></i>
                                    <span class="required" aria-required="true">*</span>
                                 </label>
                                 <input type="text" class="form-control" name="ux_txt_start_ip_range" id="ux_txt_start_ip_range" onfocus="prevent_paste_captcha_bank(this.id);" onblur="check_captcha_bank_ip_ranges_all(this);" value="" onkeyPress="valid_ip_address_captcha_bank(event);" placeholder="<?php echo $cpb_manage_ip_ranges_start_range_placeholder; ?>">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpb_manage_ip_ranges_end_range_title; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_manage_ip_ranges_end_range_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" aria-required="true">*</span>
                                 </label>
                                 <input type="text" class="form-control" name="ux_txt_end_range" id="ux_txt_end_range" onfocus="prevent_paste_captcha_bank(this.id);" onblur="check_captcha_bank_ip_ranges_all(this);" value="" onkeyPress="valid_ip_address_captcha_bank(event);" placeholder="<?php echo $cpb_manage_ip_ranges_end_range_placeholder; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpb_block_for_title; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_manage_ip_ranges_block_tooltip; ?>" data-placement="right"></i>
                              <span class="required" aria-required="true">*</span>
                           </label>
                           <select name="ux_ddl_blocked" id="ux_ddl_blocked" class="form-control">
                              <option value="1Hour"><?php echo $cpb_one_hour; ?></option>
                              <option value="12Hour"><?php echo $cpb_twelve_hours; ?></option>
                              <option value="24hours"><?php echo $cpb_twenty_four_hours; ?></option>
                              <option value="48hours"><?php echo $cpb_forty_eight_hours; ?></option>
                              <option value="week"><?php echo $cpb_one_week; ?></option>
                              <option value="month"><?php echo $cpb_one_month; ?></option>
                              <option value="permanently"><?php echo $cpb_permanently; ?></option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label class="control-label">
                              <?php echo $cpb_comments; ?> :
                              <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_manage_ip_ranges_comment; ?>" data-placement="right"></i>
                           </label>
                           <textarea class="form-control" name="ux_txtarea_manage_ip_range" id="ux_txtarea_manage_ip_range" rows="4" placeholder="<?php echo $cpb_placeholder_comment; ?>"></textarea>
                        </div>
                        <div class="line-separator"></div>
                        <div class="form-actions">
                           <div class="pull-right">
                              <input type="button" class="btn vivid-green" name="ux_btn_clear" id="ux_btn_clear" value="<?php echo $cpb_button_clear; ?>" onclick="clear_value_ip_range_captcha_bank();"/>
                              <input type="submit" class="btn vivid-green" name="ux_btn_advance_security_ip_range_submit" id="ux_btn_advance_security_ip_range_submit" value="<?php echo $cbp_manage_ip_ranges_block; ?>">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-wrench"></i>
                     <?php echo $cpb_manage_ip_ranges_view_block; ?>
                  </div>
               </div>
               <div class="portlet-body form">
                  <form id="ux_view_manage_ip_ranges">
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpb_start_date_heading; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_manage_ip_ranges_start_date_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                                 </label>
                                 <div class="input-icon-custom right">
                                    <input type="text" class="form-control" value="<?php echo date("m/d/Y", $start_date) ?>" name="ux_txt_cpb_start_date" id="ux_txt_cpb_start_date" onkeypress="prevent_data_captcha_bank(event);"  placeholder="<?php echo $cpb_start_date_placeholder; ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label class="control-label">
                                    <?php echo $cpb_end_date_heading; ?> :
                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $cpb_manage_ip_ranges_end_date_tooltip; ?>" data-placement="right"></i>
                                    <span class="required" area-required="true" >* <?php echo " ( " . $cpb_premium_editions_label . " ) "; ?></span>
                                 </label>
                                 <input type="text" class="form-control" name="ux_txt_cpb_end_date" value="<?php echo date("m/d/Y", $timestamp) ?>" id="ux_txt_cpb_end_date" onkeypress="prevent_data_captcha_bank(event);" placeholder="<?php echo $cpb_end_date_placeholder; ?>">
                              </div>
                           </div>
                        </div>
                        <div class="form-actions">
                           <div class="pull-right">
                              <input type="submit" class="btn vivid-green" name="ux_btn_ip_range" id="ux_btn_ip_range" value="<?php echo $cpb_submit; ?>">
                           </div>
                        </div>
                        <div class="line-separator"></div>
                        <div class="table-top-margin">
                           <select name="ux_ddl_manage_ip_range" id="ux_ddl_manage_ip_range" class="custom-bulk-width">
                              <option value=""><?php echo $cpb_bulk_action; ?></option>
                              <option value="delete" style="color: red;"><?php echo $cpb_delete . " ( " . $cpb_premium_editions_label . " ) "; ?></option>
                           </select>
                           <input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo $cpb_apply; ?>" onclick="premium_edition_notification_captcha_bank();">
                        </div>
                        <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_manage_ip_range">
                           <thead>
                              <tr>
                                 <th style="text-align: center;" class="chk-action">
                                    <input type="checkbox" name="ux_chk_all_manage_ip_range" id="ux_chk_all_manage_ip_range">
                                 </th>
                                 <th>
                                    <label class="control-label">
                                       <?php echo $cpb_ip_ranges; ?>
                                    </label>
                                 </th>
                                 <th>
                                    <label class="control-label">
                                       <?php echo $cpb_location; ?>
                                    </label>
                                 </th>
                                 <th>
                                    <label class="control-label">
                                       <?php echo $cpb_block_time; ?>
                                    </label>
                                 </th>
                                 <th>
                                    <label class="control-label">
                                       <?php echo $cpb_release_time; ?>
                                    </label>
                                 </th>
                                 <th>
                                    <label class="control-label">
                                       <?php echo $cpb_comments; ?>
                                    </label>
                                 </th>
                                 <th style="text-align:center;" class="chk-action">
                                    <label class="control-label">
                                       <?php echo $cpb_action; ?>
                                    </label>
                                 </th>
                              </tr>
                           </thead>
                           <tbody id="dynamic_table_filter">
                              <?php
                              foreach ($manage_ip_range_date as $row) {
                                 ?>
                                 <tr>
                                    <td style="text-align: center;">
                                       <input type="checkbox" onclick="check_all_captcha_bank('#ux_chk_all_manage_ip_range');" name="ux_chk_manage_ip_range_<?php echo intval($row["meta_id"]); ?>" id="ux_chk_manage_ip_range_<?php echo intval($row["meta_id"]); ?>" value="<?php echo intval($row["meta_id"]); ?>">
                                    </td>
                                    <td>
                                       <label>
                                          <?php $ip_address = explode(",", $row["ip_range"]) ?>
                                          <?php echo long2ip($ip_address[0]); ?> - <?php echo long2ip($ip_address[1]); ?>
                                       </label>
                                    </td>
                                    <td>
                                       <label>
                                          <?php echo $row["location"] != "" ? esc_html($row["location"]) : $cpb_na; ?>
                                       </label>
                                    </td>
                                    <td>
                                       <label>
                                          <?php echo date_i18n("d M Y h:i A", esc_attr($row["date_time"])); ?>
                                       </label>
                                    </td>
                                    <td>
                                       <label>
                                          <?php
                                          $blocking_time = esc_attr($row["blocked_for"]);
                                          switch ($blocking_time) {
                                             case "1Hour":
                                                $newtime = esc_attr($row["date_time"]) + 60 * 60;
                                                echo date_i18n("d M Y h:i A", $newtime);
                                                break;

                                             case "12Hour":
                                                $newtime = esc_attr($row["date_time"]) + 12 * 60 * 60;
                                                echo date_i18n("d M Y h:i A", $newtime);
                                                break;

                                             case "24hours":
                                                $newtime = esc_attr($row["date_time"]) + 24 * 60 * 60;
                                                echo date_i18n("d M Y h:i A", $newtime);
                                                break;

                                             case "48hours":
                                                $newtime = esc_attr($row["date_time"]) + 2 * 24 * 60 * 60;
                                                echo date_i18n("d M Y h:i A", $newtime);
                                                break;

                                             case "week":
                                                $newtime = esc_attr($row["date_time"]) + 7 * 24 * 60 * 60;
                                                echo date_i18n("d M Y h:i A", $newtime);
                                                break;

                                             case "month":
                                                $newtime = esc_attr($row["date_time"]) + 30 * 24 * 60 * 60;
                                                echo date_i18n("d M Y h:i A", $newtime);
                                                break;

                                             case "permanently":
                                                echo $cpb_never;
                                                break;
                                          }
                                          ?>
                                       </label>
                                    </td>
                                    <td>
                                       <label>
                                          <?php echo esc_html($row["comments"]); ?>
                                       </label>
                                    </td>
                                    <td class="custom-alternative" style="text-align:center;vertical-align:middle;width:10%;">
                                       <a href="javascript:void(0);">
                                          <i class="icon-custom-trash tooltips" data-original-title="<?php echo $cpb_delete; ?>" onclick="delete_ip_range_captcha_bank(<?php echo $row["meta_id"]; ?>)" data-placement="right"></i>
                                       </a>
                                    </td>
                                 </tr>
                                 <?php
                              }
                              ?>
                           </tbody>
                        </table>
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
               <a href="admin.php?page=captcha_bank_blockage_settings">
                  <?php echo $cpb_security_settings_label; ?>
               </a>
               <span>></span>
            </li>
            <li>
               <span>
                  <?php echo $cpb_block_unblock_ip_range_label; ?>
               </span>
            </li>
         </ul>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="portlet box vivid-green">
               <div class="portlet-title">
                  <div class="caption">
                     <i class="icon-custom-wrench"></i>
                     <?php echo $cpb_block_unblock_ip_range_label; ?>
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