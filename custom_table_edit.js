$(document).ready(function () {
  $("#data_table").Tabledit({
    deleteButton: false,
    editButton: false,
    columns: {
      identifier: [0, "id"],
      editable: [[1, "keyword"]],
    },
    hideIdentifier: false,
    url: "live_edit.php",
  });
});

//
//
//
//
//
//
//
//
//
//

// $(document).ready(function () {
//   $("#data_table").Tabledit({
//     deleteButton: false,
//     editButton: false,
//     columns: {
//       identifier: [0, "id"],
//       editable: [
//         [1, "image_name"],
//         [2, "computer_name"],
//         [3, "log_date"],
//       ],
//     },
//     hideIdentifier: false,
//     url: "live_edit.php",
//   });
// });
