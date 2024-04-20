function validatePassword() {
    let password = document.getElementById('password').value;
    let confirm = document.getElementById('confirm').value;
    let gdpr = document.getElementById('gdpr').checked;
    let confirmError = document.getElementById('confirm-error');
    let gdprError = document.getElementById('gdpr-error');

    let valid = password === confirm;

    if (!valid) confirmError.style = 'display:flex;';
    else confirmError.style = 'display:none;';

    if (!gdpr) gdprError.style = 'display:inline;';
    else gdprError.style = 'display:none;';

    return valid && gdprError;
}

function toggleLoginButtons() {
    let notLogged = document.getElementsByClassName('not-logged');
    let logged = document.getElementsByClassName('logged');

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = () => {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText) {
                for (let i = 0; i < notLogged.length; i++) {
                    notLogged[i].style = 'display:none;';
                    logged[i].style = 'display:flex;';
                }
            } else {
                for (let i = 0; i < notLogged.length; i++) {
                    notLogged[i].style = 'display:flex;';
                    logged[i].style = 'display:none;';
                }
            }
        } else if (xhttp.readyState == 4) {
            alert(
                'Error contacting server ! ' +
                    xhttp.status +
                    ' ' +
                    xhttp.statusText
            );
        }
    };

    xhttp.open('POST', 'checkLoginStatus.php', true);
    xhttp.send();
}

function attendance() {
    let eventsAttended;
    $.post('checkEventsAttended.php', (data) => {
        eventsAttended = JSON.parse(data);
        eventsAttended.forEach((event) => {
            $('.attend').each((i, btn) => {
                let eventID = $(btn).attr('data-event-id');
                if (eventID === event.eventID) {
                    $(btn).removeClass('attend btn-primary');
                    $(btn).addClass('unattend btn-danger');
                    $(btn).text('Unattend');
                }
            });
        });
    });

    $('.attend, .unattend').on('click', (e) => {
        let targetButton = $(e.target);
        let eventID = targetButton.attr('data-event-id');
        let attended = targetButton.attr('class').includes('unattend');

        $.post(
            attended ? 'deleteEventsAttended.php' : 'addEventsAttended',
            { eventID },
            () => {
                if (attended) {
                    targetButton.removeClass('unattend btn-danger');
                    targetButton.addClass('attend btn-primary');
                    targetButton.text('Attend');
                } else {
                    targetButton.removeClass('attend btn-primary');
                    targetButton.addClass('unattend btn-danger');
                    targetButton.text('Unattend');
                }
            }
        );
    });
}

function showPassword() {
    $('.show-pass').on('click', (e) => {
        let inputs = $("[name='password'], #confirm");
        let current = inputs.attr('type');
        inputs.attr('type', current == 'password' ? 'text' : 'password');
    });
}

function description() {
    $('.member').on('click', (e) => {
        $(e.target).parent().next().toggle();
    });

    $('.description').hide();
}

window.onload = () => {
    toggleLoginButtons();
    attendance();
    description();
    showPassword();
};
