window.addEventListener('load', (event) => {
    event.preventDefault();
    showData();
});

function showData() {
    const base_url = window.location.origin;
    fetch(base_url + '/show', {
        method: 'POST'
    }).then(res => res.json())
    .then((data) => {
        // console.log(data);
        let table = document.querySelector('#sortTable tbody');
        table.innerHTML = '';
        let count = 1;
        data.forEach(function (arr) {
            let tr = document.createElement("tr");
            tr.innerHTML += `<td>${count}</td>`;
            tr.innerHTML += `<td>${arr.name}</td>`;
            tr.innerHTML += `<td>${arr.type}</td>`;
            tr.innerHTML += `<td>${arr.year_of_manufacture}</td>`;
            tr.innerHTML += `<td>${arr.date_of_purchase}</td>`;
            tr.innerHTML += `<td>${arr.created_at}</td>`;
            tr.innerHTML += `<td>${arr.updated_at}</td>`;
            tr.innerHTML += `<td>
            <button id="${arr.id}" class="form-control btn btn-sm btn-primary" type="button" name="edit" data-toggle="modal" data-target="#formModal" onclick="editVehicle(this)">Edit</button>
            <button id="${arr.id}" class="form-control btn btn-sm btn-danger" type="button" name="delete" onclick="deleteVehicle(this)">Delete</button>
            </td>`;
            table.appendChild(tr);
            count++;
        });
    })
    .catch((error) => {
        console.error('Error', error);
    });
}

 const form = document.getElementById('vehicalForm');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        let formData = new FormData(form);
        // console.log(...formData);
        
        const base_url = window.location.origin;
        fetch(base_url + '/add_veh', {
            method: 'POST',
            body: formData
        }).then(res => res.json())
        .then(data => {
            if(data === true){
                form.reset();
                showData();
            }
        })
        .catch((error) => {
          console.error('Error:', error);
        });


    });

    function deleteVehicle(data) {
        // console.log(data);
        // console.log(data.id);
        const base_url = window.location.origin;
        fetch(base_url + '/delete', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ vehicle_id: data.id })
        }).then(res => res.json())
        .then((res) => {
            if(res === true) {
                
                showData();
            }
        })
        .then((error) => {
            console.error('Error:', error);
        });
    }


$('#sortTable').DataTable();


// $('#formModal').on('show.bs.modal', function (event) {
//     var button = $(event.relatedTarget) // Button that triggered the modal
//     var recipient = button.data('whatever') // Extract info from data-* attributes
//     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
//     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
//     // var modal = $(this)
//     console.log(this.id);
//     // modal.find('.modal-title').text('New message to ' + recipient)
//     // modal.find('.modal-body input').val(recipient)
//   });

function editVehicle(data) {
    // console.log(data.id);
    const base_url = window.location.origin;
        fetch(base_url + '/UpdateData', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ vehicle_id: data.id })
        }).then(res => res.json())
        .then((res) => {
            // console.log(res);process.exit();
            let name = document.getElementById('uName');
            let type = document.querySelectorAll('#uType option');
            let yom = document.getElementById('uyom');
            let dop = document.getElementById('udop');
            let veh = document.getElementById('vehicle_id');

            res.forEach(function(data) {
                name.setAttribute('value', data.name);
                type.forEach(function(opt){
                    if(opt.value === data.type){
                        opt.setAttribute('selected', 'selected');
                    }
                });
                yom.setAttribute('value', data.year_of_manufacture);
                dop.setAttribute('value', data.date_of_purchase);
                veh.setAttribute('value', data.id);
            });
            
        })
        .then((error) => {
            console.error('Error:', error);
        });

    // $('#formModal').modal('show')
}

const updateForm = document.getElementById('vehicalFormUpdate');
updateForm.addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(updateForm);
        // console.log(...formData);
        // formData.set('vehicle_id', 72);
        
        const base_url = window.location.origin;
        fetch(base_url + '/update', {
            method: 'POST',
            body: formData
        }).then(res => res.json())
        .then(data => {
            if(data === true){
                let name = document.getElementById('uName');
                name.removeAttribute('value');
                // console.log(name);
                let type = document.querySelectorAll('#uType option');
                let yom = document.getElementById('uyom');
                let dop = document.getElementById('udop');
                let veh = document.getElementById('vehicle_id');
                // name.removeAttribute('value');
                type.forEach(function(opt){
                    opt.removeAttribute('selected');
                });
                // type.removeAttribute('value');
                yom.removeAttribute('value');
                dop.removeAttribute('value');
                veh.removeAttribute('value');
                setTimeout(function(){
                    $('#formModal').modal('hide');
                }, 300);
               
                updateForm.reset();
                showData();
            }
        })
        .catch((error) => {
          console.error('Error:', error);
        });

});