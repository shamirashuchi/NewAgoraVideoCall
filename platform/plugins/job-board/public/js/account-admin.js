(()=>{"use strict";$(document).ready((function(){$(document).on("click","#is_change_password",(function(e){$(e.currentTarget).is(":checked")?$("input[type=password]").closest(".form-group").removeClass("hidden").fadeIn():$("input[type=password]").closest(".form-group").addClass("hidden").fadeOut()})),$(document).on("click",".btn-trigger-add-credit",(function(e){e.preventDefault(),$("#add-credit-modal").modal("show")})),$(document).on("click",".btn-trigger-add-education",(function(e){e.preventDefault(),$("#add-education-modal").modal("show")})),$(document).on("click",".btn-trigger-edit-education",(function(e){e.preventDefault();var o=$(e.currentTarget);$.ajax({type:"GET",cache:!1,url:o.data("section"),success:function(e){e.error?Botble.showNotice("error",e.message):($("#edit-education-modal .modal-body").html(""),$("#edit-education-modal .modal-body").append(e),$("#edit-education-modal").modal("show")),o.removeClass("button-loading")},error:function(e){Botble.handleError(e),o.removeClass("button-loading")}})})),$(document).on("click","#confirm-edit-education-button",(function(e){e.preventDefault();var o=$(e.currentTarget);o.addClass("button-loading"),$.ajax({type:"POST",cache:!1,url:o.closest(".modal-content").find("form").prop("action"),data:o.closest(".modal-content").find("form").serialize(),success:function(e){e.error?Botble.showNotice("error",e.message):(Botble.showNotice("success",e.message),$("#edit-education-modal").modal("hide"),o.closest(".modal-content").find("form").get(0).reset(),$("#education-histories").load($(".page-content form").prop("action")+" #education-histories > *")),o.removeClass("button-loading")},error:function(e){Botble.handleError(e),o.removeClass("button-loading")}})})),$(document).on("click","#confirm-add-education-button",(function(e){e.preventDefault();var o=$(e.currentTarget);o.addClass("button-loading"),$.ajax({type:"POST",cache:!1,url:o.closest(".modal-content").find("form").prop("action"),data:o.closest(".modal-content").find("form").serialize(),success:function(e){e.error?Botble.showNotice("error",e.message):(Botble.showNotice("success",e.message),$("#add-education-modal").modal("hide"),o.closest(".modal-content").find("form").get(0).reset(),$("#education-histories").load($(".page-content form").prop("action")+" #education-histories > *")),o.removeClass("button-loading")},error:function(e){Botble.handleError(e),o.removeClass("button-loading")}})})),$(document).on("click","#confirm-add-credit-button",(function(e){e.preventDefault();var o=$(e.currentTarget);o.addClass("button-loading"),$.ajax({type:"POST",cache:!1,url:o.closest(".modal-content").find("form").prop("action"),data:o.closest(".modal-content").find("form").serialize(),success:function(e){e.error?Botble.showNotice("error",e.message):(Botble.showNotice("success",e.message),$("#add-credit-modal").modal("hide"),o.closest(".modal-content").find("form").get(0).reset(),$("#credit-histories").load($(".page-content form").prop("action")+" #credit-histories > *")),o.removeClass("button-loading")},error:function(e){Botble.handleError(e),o.removeClass("button-loading")}})})),$(document).on("click",".show-timeline-dropdown",(function(e){e.preventDefault(),$($(e.currentTarget).data("target")).slideToggle(),$(e.currentTarget).closest(".comment-log-item").toggleClass("bg-white")})),$(document).on("click",".deleteDialog",(function(e){e.preventDefault();var o=$(e.currentTarget);$(".delete-crud-entry").data("section",o.data("section")),$(".modal-confirm-delete").modal("show")})),$(".delete-crud-entry").on("click",(function(e){e.preventDefault();var o=$(e.currentTarget);o.addClass("button-loading");var t=o.data("section");$.ajax({url:t,type:"POST",data:{_method:"DELETE"},success:function(e){e.error?Botble.showError(e.message):(Botble.showSuccess(e.message),$("#education-histories").load($(".page-content form").prop("action")+" #education-histories > *"),$("#experience-histories").load($(".page-content form").prop("action")+" #experience-histories > *")),o.closest(".modal").modal("hide"),o.removeClass("button-loading")},error:function(e){Botble.handleError(e),o.removeClass("button-loading")}})})),$(document).on("click",".btn-trigger-add-experience",(function(e){e.preventDefault(),$("#add-experience-modal").modal("show"),Botble.initResources()})),$(document).on("click","#confirm-add-experience-button",(function(e){e.preventDefault();var o=$(e.currentTarget);o.addClass("button-loading"),$.ajax({type:"POST",cache:!1,url:o.closest(".modal-content").find("form").prop("action"),data:o.closest(".modal-content").find("form").serialize(),success:function(e){e.error?Botble.showNotice("error",e.message):(Botble.showNotice("success",e.message),$("#add-experience-modal").modal("hide"),o.closest(".modal-content").find("form").get(0).reset(),$("#experience-histories").load($(".page-content form").prop("action")+" #experience-histories > *")),o.removeClass("button-loading")},error:function(e){Botble.handleError(e),o.removeClass("button-loading")}})})),$(document).on("click",".btn-trigger-edit-experience",(function(e){e.preventDefault();var o=$(e.currentTarget);$.ajax({type:"GET",cache:!1,url:o.data("section"),success:function(e){e.error?Botble.showNotice("error",e.message):($("#edit-experience-modal .modal-body").html(""),$("#edit-experience-modal .modal-body").append(e),$("#edit-experience-modal").modal("show")),o.removeClass("button-loading")},error:function(e){Botble.handleError(e),o.removeClass("button-loading")}})})),$(document).on("click","#confirm-edit-experience-button",(function(e){e.preventDefault();var o=$(e.currentTarget);o.addClass("button-loading"),$.ajax({type:"POST",cache:!1,url:o.closest(".modal-content").find("form").prop("action"),data:o.closest(".modal-content").find("form").serialize(),success:function(e){e.error?Botble.showNotice("error",e.message):(Botble.showNotice("success",e.message),$("#edit-experience-modal").modal("hide"),o.closest(".modal-content").find("form").get(0).reset(),$("#experience-histories").load($(".page-content form").prop("action")+" #experience-histories > *")),o.removeClass("button-loading")},error:function(e){Botble.handleError(e),o.removeClass("button-loading")}})}))}))})();