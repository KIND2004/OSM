var bootstrapmodal;

function Login(user) {

    var username = document.getElementById("username");
    var password = document.getElementById("password");

    var form = new FormData();
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("user", user);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "UnVerified") {
                var modal = document.getElementById("code");
                bootstrapmodal = new bootstrap.Modal(modal);
                bootstrapmodal.show();
            } else if (Response == "Success") {
                window.location = user + "Home.php";
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "LogInProcess.php", true);
    Request.send(form);

}

function Invite(user) {

    var email = document.getElementById("email");
    var username = document.getElementById("username");
    var password = document.getElementById("password");

    var form = new FormData();
    form.append("email", email.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("user", user);

    if (user == "Student") {
        var grade = document.getElementById("grade");
        form.append("grade", grade.value);
    }

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                alert("Invitation Sent");
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "InviteProcess.php", true);
    Request.send(form);

}

function Verify(user) {

    var username = document.getElementById("username");
    var code = document.getElementById("verification_code");

    var form = new FormData();
    form.append("username", username.value);
    form.append("code", code.value);
    form.append("user", user);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                var URL = user + "Home.php";
                window.location = URL;
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "VerifyProcess.php", true);
    Request.send(form);

}

function LogOut(user) {

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location = "index.php";
            } else {
                alert(Response);
            }
        }
    }

    Request.open("GET", "LogOutProcess.php?user=" + user, true);
    Request.send();

}

function UpdateProfile(user) {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var imgpath = document.getElementById("imgpath");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("user", user);
    form.append("img", imgpath.files[0]);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "ProfileProcess.php", true);
    Request.send(form);

}

function UploadImage() {
    var image = document.getElementById("imgpath");
    var view = document.getElementById("prev");

    image.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        view.src = url;
    }
}

function ViewUser(user, id) {
    window.location = "UserDetails.php?user=" + user + "&id=" + id;
}

function ChangeStatus(user, id) {

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("GET", "ChangeStatusProcess.php?user=" + user + "&id=" + id, true);
    Request.send();

}

function AddNewSubjecttoTecherModal() {
    var modal = document.getElementById("AddNewSubjecttoTecherModal");
    bootstrapmodal = new bootstrap.Modal(modal);
    bootstrapmodal.show();
}

function AddNewSubjecttoTecher(id) {

    var subject = document.getElementById("subject");
    var grade = document.getElementById("grade");

    var form = new FormData();
    form.append("subject", subject.value);
    form.append("grade", grade.value);
    form.append("id", id);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "AddNewSubjecttoTecherProcess.php", true);
    Request.send(form);

}

function RemoveTeacherHasSubject(id) {

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("GET", "RemoveTeacherHasSubjectProcess.php?id=" + id, true);
    Request.send();

}

function LoadGrade() {

    var subject = document.getElementById("subject").value;

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            var grade = document.getElementById("grade");
            grade.innerHTML = Response;
        }
    }

    Request.open("GET", "LoadGradeProcess.php?subject=" + subject, true);
    Request.send();

}

function RemoveNotes(id) {

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("GET", "RemoveNotesProcess.php?id=" + id, true);
    Request.send();

}

function AddNewNotesModal() {
    var modal = document.getElementById("AddNewNotesModal");
    bootstrapmodal = new bootstrap.Modal(modal);
    bootstrapmodal.show();
}

function AddNewNotes(id) {

    var subject = document.getElementById("subject");
    var grade = document.getElementById("grade");
    var note = document.getElementById("note");

    var form = new FormData();
    form.append("subject", subject.value);
    form.append("grade", grade.value);
    form.append("note", note.files[0]);
    form.append("id", id);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "AddNewNotesProcess.php", true);
    Request.send(form);

}

function RemoveAssignments(id) {

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("GET", "RemoveAssignmentsProcess.php?id=" + id, true);
    Request.send();

}

function AddNewAssignmentsModal() {
    var modal = document.getElementById("AddNewAssignmentsModal");
    bootstrapmodal = new bootstrap.Modal(modal);
    bootstrapmodal.show();
}

function AddNewAssignments(id) {

    var subject = document.getElementById("subject");
    var grade = document.getElementById("grade");
    var assignment = document.getElementById("assignment");

    var form = new FormData();
    form.append("subject", subject.value);
    form.append("grade", grade.value);
    form.append("assignment", assignment.files[0]);
    form.append("id", id);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "AddAssignmentsProcess.php", true);
    Request.send(form);

}

function UploadAssignment(id) {

    var result = document.getElementById("result");

    var form = new FormData();
    form.append("result", result.files[0]);
    form.append("id", id);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "UploadAssignmentProcess.php", true);
    Request.send(form);

}

function AddAssignmentMarksModal(id) {
    var modal = document.getElementById("AddAssignmentMarksModal" + id);
    bootstrapmodal = new bootstrap.Modal(modal);
    bootstrapmodal.show();
}

function AddMarks(id) {

    var marks = document.getElementById("marks" + id);

    var form = new FormData();
    form.append("marks", marks.value);
    form.append("id", id);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "AddMarksProcess.php", true);
    Request.send(form);

}

function ReleaseMarks(id) {

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("GET", "ReleaseMarksProcess.php?id=" + id, true);
    Request.send();

}

function ChangeGradeModal() {
    var modal = document.getElementById("ChangeGradeModal");
    bootstrapmodal = new bootstrap.Modal(modal);
    bootstrapmodal.show();
}

function UpdateGrade(id) {

    var updateGrade = document.getElementById("updateGrade");

    var form = new FormData();
    form.append("updateGrade", updateGrade.value);
    form.append("id", id);

    var Request = new XMLHttpRequest();

    Request.onreadystatechange = function () {
        if (Request.readyState == 4) {
            var Response = Request.responseText;
            if (Response == "Success") {
                window.location.reload();
            } else {
                alert(Response);
            }
        }
    }

    Request.open("POST", "UpdateGradeProcess.php", true);
    Request.send(form);

}