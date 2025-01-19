let get_add_attendance = document.getElementById('add_attendance');
let get_form_container = document.getElementById('form_container');
let get_cancel_button = document.getElementById('cancel_button');
let get_add_button = document.getElementById('add_button');
let get_first_name = document.getElementById('first_name');
let get_middle_name = document.getElementById('middle_name');
let get_last_name = document.getElementById('last_name');
let student_list = document.querySelector('#student_list tbody');

// Show the form
get_add_attendance.addEventListener('click', () => {
    get_form_container.style.display = 'block';
});

// Hide the form
get_cancel_button.addEventListener('click', (event) => {
    event.preventDefault();
    get_form_container.style.display = 'none';
});

// Handle form submission
get_add_button.addEventListener('click', async (event) => {
    event.preventDefault();

    const firstName = get_first_name.value.trim();
    const middleName = get_middle_name.value.trim();
    const lastName = get_last_name.value.trim();

    if (firstName && lastName) {
        // Send data to the server
        const response = await fetch('add_student.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                first_name: firstName,
                middle_name: middleName,
                last_name: lastName,
            }),
        });

        const result = await response.json();

        if (result.success) {
            // Update the table dynamically
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${result.data.student_id}</td>
                <td>${result.data.first_name}</td>
                <td>${result.data.middle_name}</td>
                <td>${result.data.last_name}</td>
                <td>${result.data.present_time}</td>
            `;
            student_list.appendChild(newRow);

            // Clear the form and hide it
            get_first_name.value = '';
            get_middle_name.value = '';
            get_last_name.value = '';
            get_form_container.style.display = 'none';
        } else {
            alert('Failed to add student.');
        }
    } else {
        alert('First name and last name are required.');
    }
});
