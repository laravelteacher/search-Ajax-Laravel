/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/script.js":
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var loading = false; // Click to Show modal of Add New Data

  $('#add').click(function () {
    $('#addModal').modal('show');
  }); //Add the Student  

  $("#addStudent").validate({
    rules: {
      name: "required",
      email: "required"
    },
    messages: {},
    submitHandler: function submitHandler(form) {
      var form_action = $("#addStudent").attr("action");
      $.ajax({
        data: $('#addStudent').serialize(),
        url: form_action,
        type: "POST",
        dataType: 'json',
        success: function success(data) {
          var student = '<tr id="' + data.id + '">'; //   student += '<td>' + data.id + '</td>';
          //   student += '<td>' + data.name + '</td>';
          //   student += '<td>' + data.email + '</td>';

          student += '<td>' + data.type + '</td>';
          student += '<td>' + data.amount + '</td>';
          student += '<td>' + data.category + '</td>';
          student += '<td>' + data.mode + '</td>';
          student += '<td>' + data.note + '</td>';
          student += '<td>' + data.date + '</td>';
          student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
          student += '</tr>';
          $('#studentTable tbody').prepend(student);
          $('#addStudent')[0].reset();
          $('#addModal').modal('hide');
        },
        error: function error(data) {}
      });
    }
  }); //Show view the Student  

  $("#viewStudent").validate({
    rules: {
      name: "required",
      email: "required"
    },
    messages: {},
    submitHandler: function submitHandler(form) {
      var form_action = $("#viewStudent").attr("action");
      $.ajax({
        data: $('#viewStudent').serialize(),
        url: form_action,
        type: "POST",
        dataType: 'json',
        success: function success(data) {},
        error: function error(data) {}
      });
    }
  }); //When click edit student

  $('body').on('click', '.btnEdit', function () {
    if (loading) {
      return;
    }

    var student_id = $(this).attr('data-id');
    $.get('student/' + student_id + '/edit', function (data) {
      loading = false;
      $('#updateModal').modal('show');
      $('#updateStudent #hdnStudentId').val(data.id);
      $('#updateStudent #name').val(data.name);
      $('#updateStudent #email').val(data.email);
      $('#updateStudent #type').val(data.type);
      $('#updateStudent #amount').val(data.amount);
      $('#updateStudent #category').val(data.category);
      $('#updateStudent #mode').val(data.mode);
      $('#updateStudent #note').val(data.note);
      $('#updateStudent #date').val(data.date);
    });
  }); //When click edit student

  $('body').on('click', '.btnEdi', function () {
    if (loading) {
      return;
    }

    var student_id = $(this).attr('data-id');
    $.get('student/' + student_id + '/showview', function (data) {
      loading = false;
      $('#showModal').modal('show');
      $('#updateStudent #hdnStudentId').val(data.id);
      $('#updateStudent #name').val(data.name);
      $('#updateStudent #email').val(data.email);
      $('#updateStudent #type').val(data.type);
      $('#updateStudent #amount').val(data.amount);
      $('#updateStudent #category').val(data.category);
      $('#updateStudent #mode').val(data.mode);
      $('#updateStudent #note').val(data.note);
      $('#updateStudent #date').val(data.date);
    });
  }); // Update the student

  $("#updateStudent").validate({
    //  rules: {
    // 		txtFirstName: "required",
    // 		txtLastName: "required",
    // 		txtAddress: "required"
    // 	},
    messages: {},
    submitHandler: function submitHandler(form) {
      var form_action = $("#updateStudent").attr("action");
      $.ajax({
        data: $('#updateStudent').serialize(),
        url: form_action,
        type: "POST",
        dataType: 'json',
        success: function success(data) {
          // var student = '<tr id="'+data.id+'">';
          //   student += '<td>' + data.name + '</td>';
          //   student += '<td>' + data.email + '</td>';
          var student = '<td>' + data.type + '</td>';
          student += '<td>' + data.amount + '</td>';
          student += '<td>' + data.category + '</td>';
          student += '<td>' + data.mode + '</td>';
          student += '<td>' + data.note + '</td>';
          student += '<td>' + data.date + '</td>';
          student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
          $('#studentTable tbody #' + data.id).html(student);
          $('#updateStudent')[0].reset();
          $('#updateModal').modal('hide');
        },
        error: function error(data) {}
      });
    }
  }); //delete student

  $('body').on('click', '.btnDelete', function () {
    var student_id = $(this).attr('data-id');
    $.get('student/' + student_id + '/delete', function (data) {
      $('#studentTable tbody #' + student_id).remove();
    });
  });
}); //   Paginate Ajax
// $(function () {
//     var urll = 'images/Chrysanthemum.jpg';
//     var image = new Image();
//     var loading = false; 
//     image.src = urll;
//       $('body').on('click', '.pagination a', function (e) {
//           e.preventDefault();
//           if (loading){
//               return;
//           }
//           // $('#load').append(image);
//           var url = $(this).attr('href');
//           window.history.pushState("", "", url);
//           loadPosts(url);
//       });
//       function loadPosts(url) {
//           loading = true;
//           $.ajax({
//               url: url
//           }).done(function (data) {
//               loading = false;
//               $('.posts').html(data);
//           }).fail(function () {
//               loading = false;
//               console.log("Failed to load data!");
//           });
//       }
//   });

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/script.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\ajax11\pro_money\resources\js\script.js */"./resources/js/script.js");


/***/ })

/******/ });