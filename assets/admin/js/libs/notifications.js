angular.module("MyApp", []).controller("MyController", function($scope,$http) {
    $scope.save_notification = function()
    {
        save_notification_success_cb = function(data)
        {
            if(data.status == "success")
            {
                alert_box("Successfully Saved");
                window.location.reload();
            }
        }
        notification = $("#wysiwyg").val();
        notification_email = $("#wysiwyg1").val();
        
        packages = $scope.packages || '';
        packages = packages.toString();
        request_data = {};
        request_data['notification'] = notification;
        request_data['packages'] = packages;
        request_data['notification_email'] = notification_email;
        SSK.site_call("AJAX",window._site_url+"admin_notifications/add_notification",request_data, save_notification_success_cb);
    }

    $scope.edit_notification = function()
    {
        edit_notification_success_cb = function(data)
        {
            if(data.status == "success")
            {
                alert_box("Successfully Saved")
            }
        }
        notification = $("#wysiwyg").val();
        notification_status = $("#notification_status").val();
        notification_id = $("#notification_id").val();
        request_data = {};
        request_data['notification'] = notification;
        request_data['notification_status'] = notification_status;
        request_data['notification_id'] = notification_id;
        SSK.site_call("AJAX",window._site_url+"admin_notifications/edit_notification",request_data,edit_notification_success_cb);
    }

    $scope.deleteNotification = function(notification_id)
    {
        if(confirm("Do you want to delete this Notification?"))
        {
            delete_notification_success_cb = function(data)
            {
                if(data.status == "success")
                {
                    alert_box("Successfully deleted");
                    $("#notification-id-"+notification_id).remove();
                }
            }

            request_data = {};
            request_data['notification_id'] = notification_id;
            SSK.site_call("AJAX",window._site_url+"admin_notifications/delete_notification",request_data, delete_notification_success_cb);            
        }

    }
});