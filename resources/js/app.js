require('./bootstrap');
window.$ = window.jQuery = require('jquery');
import 'jquery-ui/ui/widgets/dialog';
import 'jquery-ui/themes/base/dialog.css';
import Swal from 'sweetalert2';
window.Swal = Swal;

import Chart from 'chart.js/auto';


const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
      toast.style.width = 'auto'
    }
  });
  
window.Toast = Toast;

window.popupDeleteConfirmation = {
    title: 'Are you sure to delete?',
    text: 'You won\'t be able to revert this!',
    icon: 'warning',
    iconColor: '#4EB3D3',
    showCancelButton: true,
    confirmButtonColor: '#CF3548',
    cancelButtonColor: '#CCCCCC',
    confirmButtonText: 'Delete'
}

window.confirmDelete = form => {
    form.addEventListener('submit', event => {
        event.preventDefault();
        Swal.fire(popupDeleteConfirmation).then(result => {
            if (result.isConfirmed) form.submit()
        });
    });
}

window.popupAcceptConfirmation = {
    title: 'Are you sure to Accept?',
    text: 'You won\'t be able to revert this!',
    icon: 'warning',
    iconColor: '#4EB3D3',
    showCancelButton: true,
    confirmButtonColor: '#719252',
    cancelButtonColor: '#CCCCCC',
    confirmButtonText: 'Accept'
}

window.confirmAccept= form => {
    form.addEventListener('submit', event => {
        event.preventDefault();
        Swal.fire(popupAcceptConfirmation).then(result => {
            if (result.isConfirmed) form.submit()
        });
    });
}

window.popupPromoteConfirmation = {
    title: 'Are you sure to Promote?',
    text: 'You won\'t be able to revert this!',
    icon: 'warning',
    iconColor: '#4EB3D3',
    showCancelButton: true,
    confirmButtonColor: '#719252',
    cancelButtonColor: '#CCCCCC',
    confirmButtonText: 'Accept'
}

window.confirmPromote= form => {
    form.addEventListener('submit', event => {
        event.preventDefault();
        Swal.fire(popupPromoteConfirmation).then(result => {
            if (result.isConfirmed) form.submit()
        });
    });
}


window.sendAjax = (method, url, data) => {
    let token = $('meta[name="csrf-token"]').attr('content')
    $.ajax({
        method: method,
        url: url,
        data: data,
        headers: {
            'X-CSRF-TOKEN': token
        }
    }).done((response)=>{
        if(response.error){
            $(".error-message").text(JSON.stringify(response.error, null, 2).replace(/[[\]{}"']+/g,''));
        }
        else{
            window.location.reload(); 
        }
    })
}

function getRandomColor() {
    const red = Math.floor(Math.random() * 90) + 80;
    const green = Math.floor(Math.random() * 120) + 100;
    const blue = Math.floor(Math.random() * 101) + 150;
    const colorCode = 'rgba(' + red + "," + green + "," + blue + ", 1)"
    return colorCode;
  }

window.createChart = (type, canvasId, l, data) => {

    const filteredLabels = l.filter((label, index) => {
        return data[index] !== 0;
    });

    let bgColor = [];

    bgColor.push("rgba(78, 179, 211, 1)");
    bgColor.push("rgba(43, 140, 190, 1)");
    bgColor.push("rgba(34, 94, 168, 1)");
    bgColor.push("rgba(8, 64, 129, 1)");

    for(let i = 0; i < data.length; i++){
        bgColor.push(getRandomColor())
    }

    let chartData;
    let options;

    if(type == "radar"){

        chartData = {
            labels: l,
            datasets: [{
                data: data,
                fill: true,
                backgroundColor: 'rgba(78, 179, 211, 0.4)'
            }]
        }

        options = {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                r : {
                    pointLabels: {
                        font: {
                            size: 6
                        },
                        display: false,
                    },
                    angleLines: {
                        color: '#EAF4F8',
                    }
                }
            }
        }
    }
    else if (type == "bar"){
        chartData = {
            labels: filteredLabels,
            datasets: [{
                data: data,
                backgroundColor: bgColor,
            }]
        };
        options = {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom',
                },
                title: {
                    display: false,
                }
            }
            };
    }
    else{
        chartData = {
            labels: filteredLabels,
            datasets: [{
                data: data,
                backgroundColor: bgColor,
            }]
        };
        options = {
            responsive: true,
            scales: {
                angleLines: {
                    display: true
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false,
                }
            }
            };
    }

    const myChart = new Chart(document.getElementById(canvasId), {
        type: type,
        data: chartData,
        options: options
    });
}

$(document).ready(() => {

    $("#loading-container").hide();

    $(".cancel-popup-button").click(function(){
        $(this).closest('.popup-container').hide();
        $(".error-message").text("");
    })

    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => confirmDelete(form));

    const acceptForms = document.querySelectorAll('.accept-admin-form');
    acceptForms.forEach(form => confirmAccept(form));

    const promoteForms = document.querySelectorAll('.promote-admin-form');
    promoteForms.forEach(form => confirmPromote(form));

    // $(document).on('click', 'a:not([target="_blank"])', function() {
    //     $('#loading-container').show();
    //   });
      

    // $(document).on('load', function() {
    //     $('#loading-container').hide();
    //   });
      
    let sidebarContainer = $("#sidebar-container")
    const sidebarWidth = sidebarContainer.width()

    let contentContainer = $("#content-container")
    const contentWidth = contentContainer.width()

    let sidebarIcon = $("#sidebar-icon")

    if(sessionStorage.getItem("sidebarState") == null){
        sessionStorage.setItem("sidebarState", "open");
    }
    else if(sessionStorage.getItem("sidebarState") == "closed"){
        sidebarContainer.animate({width: "5%"});
        contentContainer.animate({width: "95%"});
        $(".sidebar-item-text").hide(150);
    }
    else{
        sidebarContainer.animate({width: sidebarWidth});
        contentContainer.animate({width: contentWidth + 50});
        $(".sidebar-item-text").show(150);
    }

    sidebarIcon.click(()=>{
        if(sessionStorage.getItem("sidebarState") == "open"){
            sidebarContainer.animate({width: "5%"});
            contentContainer.animate({width: "95%"});
            $(".sidebar-item-text").hide(150);
            sessionStorage.setItem("sidebarState", "closed");
        }
        else{
            sidebarContainer.animate({width: sidebarWidth});
            contentContainer.animate({width: contentWidth + 50});
            $(".sidebar-item-text").show(150);
            sessionStorage.setItem("sidebarState", "open");
        }
        open = !open;
    })


    $('#dropdown-menu').hide();
    $('#dropdown-toggle').hover(()=>{
        $('#dropdown-menu').toggle(200);
    });


    $('.accordion-title').click(function() {
        $(this).parent().siblings().find('.accordion-content').slideUp();
        $(this).toggleClass('active');
        $(this).next('.accordion-content').slideToggle(200).toggleClass("hidden");
    });

});

