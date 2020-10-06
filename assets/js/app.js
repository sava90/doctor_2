import $ from 'jquery';

const TIME_SCRIPT_WORK_IN_MS = 300000; //5m
const TIME_BAD_REQUEST = 500; //0.5sec

let startSendRequestTime = 0,
    currentTime = 0,
    endScriptWorkTime = 0,
    totalRequest = 0,
    totalBadRequest = 0;

$(document).ready(function() {
    $('#first-part').on('click', () => {
        setDefaultValues();
        firstPart();
    });

    $('#second-part').on('click', () => {
        setDefaultValues();
        secondPart();
    });
});

function setDefaultValues()
{
    currentTime = (new Date()).getTime();
    endScriptWorkTime = currentTime + TIME_SCRIPT_WORK_IN_MS;
    totalRequest = 0;
    totalBadRequest = 0;
}

function firstPart()
{
    if (currentTime > endScriptWorkTime) {
        $('#status').html('Finish');

        return;
    }

    let id = Math.floor((Math.random() * 10000) + 1);
    startSendRequestTime = (new Date()).getTime()

    fetch('/disease/'+id).then((response) => {
        return response.json();
    }).then((data) => {
        console.log(data);
        responseStatistics();
    }).catch((error) => {
        console.log('Error! ' + error);
    }).finally(() => {
        showStatistics();
        firstPart();
    });
}

function secondPart()
{
    if (currentTime > endScriptWorkTime) {
        $('#status').html('Finish');

        return;
    }

    let urls = [];

    for (let i = 0; i < 10; i++) {
        urls.push('/disease/' + Math.floor((Math.random() * 10000) + 1));
    }

    startSendRequestTime = (new Date()).getTime();

    Promise.all(urls.map(url =>
        fetch(url, {
            method: 'POST',
            body: JSON.stringify({'name': 'Test name'})
        })
    )).then(responses =>
        Promise.all(responses.map(response => response.json()))
    ).then((data) => {
        $.each(data, function( index, value ) {
            console.log(value);
            responseStatistics();
        });
    }).catch((error) => {
        console.log('Error! ' + error);
    }).finally(() => {
        showStatistics();
        secondPart();
    });
}

function responseStatistics()
{
    let receiveDate = (new Date()).getTime();

    if (receiveDate - startSendRequestTime > TIME_BAD_REQUEST) {
        totalBadRequest++;
    }

    currentTime = (new Date()).getTime();
    totalRequest++;
}

function showStatistics()
{
    $('#end-date-script-work').html(new Date(endScriptWorkTime));
    $('#total-request').html(totalRequest);
    $('#total-bad-request').html(totalBadRequest);
    $('#percent').html((totalBadRequest*100/totalRequest).toFixed(2)+'%');
    $('#status').html('In progress');
}