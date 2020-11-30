<?php
$color    = pr_get_chat_color(get_user_id(), 'chat_color');

$currentChatColor = !empty($color) ? $color : '#546bf1';
?>
<!-- Additional Styling -->
<style type="text/css" media="screen">
  body #pusherChat #mainChatId #membersContent a:hover {
    background: <?= $currentChatColor; ?>;
    color: #fff;
  }

  #pusherChat .pusherChatBox .msgTxt p.you {
    background: <?= $currentChatColor; ?>;
  }

  #pusherChat .chatBoxWrap #slideRight .fa-angle-double-right {
    color: <?= $currentChatColor; ?>;
  }

  #pusherChat .chatBoxWrap #slideLeft .fa-angle-double-left {
    color: <?= $currentChatColor; ?>;
  }

  .main_loader_init:before {
    content: '<?= _l("chat_accessing_channels"); ?>';
    position: absolute;
    color: #ffffff;
    top: 46%;
    margin-left: -33px;
    font-size: 15px;
  }
</style>

<script src="<?php echo base_url('modules/prchat/assets/js/tooltipster.bundle.min.js'); ?>"></script>

<!-- Check if user has permission to delete own messages enabled -->
<?php $chat_delete_option = get_option('chat_staff_can_delete_messages'); ?>
<?php $chat_desktop_messages_notifications = get_option('chat_desktop_messages_notifications'); ?>

<script>
  /*---------------* Start of main Chat helper function  *---------------*/
  var prchatSettings = {
    'pusherAuthentication': '<?php echo site_url('admin/chat/pusher_auth'); ?>',
    'usersList': '<?php echo site_url('admin/chat/users'); ?>',
    'getMessages': '<?php echo site_url('admin/chat/getMessages'); ?>',
    'getSharedFiles': '<?php echo site_url('admin/chat/getSharedFiles'); ?>',
    'getGroupSharedFiles': '<?php echo site_url('admin/chat/getGroupSharedFiles'); ?>',
    'getGroupMessages': '<?php echo site_url('admin/chat/getGroupMessages'); ?>',
    'getGroupMessagesHistory': '<?php echo site_url('admin/chat/getGroupMessagesHistory'); ?>',
    'updateUnread': '<?php echo site_url('admin/chat/updateUnread'); ?>',
    'updateClientUnread': '<?php echo site_url('admin/chat/updateClientUnreadMessages'); ?>',
    'serverPath': '<?php echo site_url('admin/chat/initiateChat'); ?>',
    'uploadMethod': '<?php echo site_url('admin/chat/uploadMethod'); ?>',
    'groupUploadMethod': '<?php echo site_url('admin/chat/groupUploadMethod'); ?>',
    'groupMessagePath': '<?php echo site_url('admin/chat/initiateGroupChat'); ?>',
    'chatLastSeenText': "<?php echo _l('chat_last_seen'); ?>",
    'noMoreMessagesText': "<?php echo _l('chat_no_more_messages_to_show'); ?>",
    'hasComeOnlineText': "<?php echo _l('chat_user_is_online'); ?>",
    'sayHiText': "<?php echo _l('chat_say_hi'); ?>",
    'deleteMessage': "<?php echo site_url('admin/chat/deleteMessage'); ?>",
    'deleteChatMessage': "<?php echo _l('chat_delete_message'); ?>",
    'onlineUsers': "<?php echo _l('chat_online_users'); ?>",
    'onlineUsersMenu': "<?php echo _l('chat_online_users_menu'); ?>",
    'newMessages': "<?php echo _l('chat_new_messages'); ?>",
    'messageIsDeleted': "<?php echo _l('chat_message_deleted'); ?>",
    'getUnread': '<?php echo json_encode($unreadMessages); ?>',
    'getClientUnreadMessages': '<?php echo site_url('admin/chat/getClientUnreadMessages'); ?>',
    'chatGroups': '<?php echo site_url('admin/chat/chatGroups'); ?>',
    'addChatGroupMembers': '<?php echo site_url('admin/chat/addChatGroupMembers'); ?>',
    'addChatGroup': '<?php echo site_url('admin/chat/addChatGroup'); ?>',
    'addNewChatGroupMembersModal': '<?php echo site_url('admin/chat/addNewChatGroupMembersModal'); ?>',
    'getMyGroups': '<?php echo site_url('admin/chat/getMyGroups'); ?>',
    'addChatMembersToGroup': '<?php echo site_url('admin/chat/addChatMembersToGroup'); ?>',
    'chatMemberLeaveGroup': '<?php echo site_url('admin/chat/chatMemberLeaveGroup'); ?>',
    'removeChatGroupUser': '<?php echo site_url('admin/chat/removeChatGroupUser'); ?>',
    'addNewChatGroup': '<?php echo site_url('admin/chat/addNewChatGroup'); ?>',
    'deleteGroup': '<?php echo site_url('admin/chat/deleteGroup'); ?>',
    'switchTheme': '<?php echo site_url('admin/chat/switchTheme'); ?>',
    'chatAnnouncement': '<?php echo site_url('admin/chat/staff_announcement'); ?>',
    'sendStaffAnnouncement': '<?php echo site_url('admin/chat/staff_get_selected_members'); ?>',
    'resetChatColors': '<?php echo site_url('admin/chat/resetChatColors'); ?>',
    'invalidColor': '<?php echo _l('chat_invalid_color_alert'); ?>',
    'areYouSure': '<?php echo _l('confirm_action_prompt'); ?>',
    // Clients
    'clientsMessagesPath': '<?php echo site_url('admin/chat/initClientChat'); ?>',
    'getMutualMessages': '<?php echo site_url('admin/chat/getMutualMessages'); ?>',
    'debug': <?php if (ENVIRONMENT != 'production') { ?> true <?php } else { ?> false <?php }; ?>
  };

  /** Helper Functions */
  /*---------------* Live internet connection tracking *---------------*/
  function handleConnectionChange(event) {
    var conn_tracker = $('.connection_field');
    if (event.type == "offline") {
      conn_tracker.fadeIn();
      conn_tracker.children('i.fa-wifi').addClass('blink');
      conn_tracker.css('background', '#f03d25');
      conn_tracker.children('i.fa-wifi').fadeIn();
    }
    if (event.type == "online") {
      conn_tracker.css('background', '#04cc04');
      conn_tracker.children('i.fa-wifi').fadeIn();
      conn_tracker.children('i.fa-wifi').removeClass('blink');
      conn_tracker.delay(4000).fadeOut(function() {
        conn_tracker.children('i.fa-wifi').fadeOut();
      });
    }
  }
  /*---------------* UI Track chat monitor current load and resize event activity for mobile and desktop version *---------------*/
  function monitorWindowActivity() {
    var groupOptions = $('body #wrapper #frame .content .chat_group_options.active');
    $(window).resize(function() {
      if ($(window).width() > 733) {
        $('#switchTheme, #announcement, #shared_user_files, #frame .groupOptions').show();
        $(groupOptions).show();
        $('body').removeClass('hide-sidebar').addClass('show-sidebar');
      } else {
        $('#switchTheme, #announcement, #sharedFiles, #shared_user_files, #frame .groupOptions').hide();
        $(groupOptions).hide();
        $('body').removeClass('show-sidebar').addClass('hide-sidebar');
      }
      if ($('#frame #sidepanel #contacts li').length > 10) {
        $('#frame #sidepanel #contacts').css({
          'overflow-y': 'scroll'
        });
      }
    });
  }
</script>