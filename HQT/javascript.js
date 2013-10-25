function staffList(){
    var mylist=document.getElementById("staff");
    window.location="http://"+document.domain+"/HQT/index.php/statistic/displaystafflist/"+mylist.options[mylist.selectedIndex].value;
}
function subjectList(){
    var mylist=document.getElementById("subject");
    window.location="http://"+document.domain+"/HQT/index.php/statistic/displaySubjectList/"+mylist.options[mylist.selectedIndex].value;
}
function studentList(){
    var mylist=document.getElementById("student");
    window.location="http://"+document.domain+"/HQT/index.php/statistic/displayStudentList/"+mylist.options[mylist.selectedIndex].value;
}
function courseList(){
    var mylist=document.getElementById("course");
    window.location="http://"+document.domain+"/HQT/index.php/statistic/displayCourseList/"+mylist.options[mylist.selectedIndex].value;
}