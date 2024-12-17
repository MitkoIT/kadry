/*
---------------------------------
    : Custom - Job Positions :
---------------------------------
*/
"use strict";

const scriptTag = document.currentScript;
const baseUrl = scriptTag.getAttribute('data-base-url');
const companyId = scriptTag.getAttribute('data-company-id');
const jobPostionId = scriptTag.getAttribute('data-job-position-id');

$('#addNodeEmployeeModalSelect').select2({
    dropdownParent: $("#addNodeEmployeeModal")
});

function addNodeEmployee() {
    const employeeId = $('#addNodeEmployeeModalSelect').val();

    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId+'/employee/'+employeeId,
        type: 'POST',
        data: {
            jobPostionId: jobPostionId,
            employeeId: employeeId
        },
        success: function () {
            window.location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function loadEmployeeToNodeEmployeeModal(employee) {
    const deleteNodeEmployeeModalUser = document.getElementById('deleteNodeEmployeeModalUser');
    const deleteNodeEmployeeModalId = document.getElementById('deleteNodeEmployeeModalId');
    
    deleteNodeEmployeeModalUser.innerText = employee.name;
    deleteNodeEmployeeModalId.value = employee.id;
}

function deleteNodeEmployee() {
    const deleteNodeEmployeeModalId = document.getElementById('deleteNodeEmployeeModalId');
    const employeeId = deleteNodeEmployeeModalId.value;
    
    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId+'/employee/'+employeeId,
        type: 'DELETE',
        success: function () {
            window.location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function deleteJobPosition() {
    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId,
        type: 'DELETE',
        success: function () {
            window.location.href = baseUrl+'stanowiska/'+companyId;
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function openChangeNodeEmployeeDescriptionModal(data) {
    const nodeEmployeeId = document.getElementById('nodeEmployeeId');
    const nodeEmployeeName = document.getElementById('nodeEmployeeName');
    const nodeEmployeeDescription = document.getElementById('nodeEmployeeDescription');
    $('#changeNodeEmployeeDescriptionModal').modal('show');

    nodeEmployeeId.value = data.id;
    nodeEmployeeName.innerHTML = data.name;
    nodeEmployeeDescription.value = data.description;
}

function saveNodeEmployeeDescription() {
    const nodeEmployeeId = document.getElementById('nodeEmployeeId');
    const nodeEmployeeDescription = document.getElementById('nodeEmployeeDescription');

    $.ajax({
        url: baseUrl+'api/v1/job-position/'+jobPostionId+'/employee/'+nodeEmployeeId.value,
        type: 'PUT',
        data: {
            description: nodeEmployeeDescription.value
        },
        success: function () {
            window.location.reload();
        },
        error: function (error) {
            console.log(error);
        }
    })
}