$(document).ready(function() {
  // Global Settings
  let edit = false;

  // Testing Jquery
  console.log('jquery is working!');
  fetchCustomers();
  $('#customer-result').hide();


  // search key type event
  $('#search').keyup(function() {
    if($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: 'customer-search.php',
        data: {search},
        type: 'POST',
        success: function (response) {
          if(!response.error) {
            let customers = JSON.parse(response);
            let template = '';
            customers.forEach(customer => {
              template += `
                     <li><a href="#" class="customer-item">${customer.firstname}</a></li>
                    ` 
            });
            $('#customer-result').show();
            $('#container').html(template);
          }
        } 
      })
    }
  });

  $('#customer-form').submit(e => {
    e.preventDefault();
    const postData = {
      firstname: $('#firstname').val(),
      lastname: $('#lastname').val(),
      phone: $('#phone').val(),
      id: $('#customerId').val()
    };
    const url = edit === false ? 'customer-add.php' : 'customer-edit.php';
    console.log(postData, url);
    $.post(url, postData, (response) => {
      console.log(response);
      fetchCustomers();
      $('#customer-form').trigger('reset');
    });
  });

  // Fetching Customers
  function fetchCustomers() {
    $.ajax({
      url: 'customer-list.php',
      type: 'GET',
      success: function(response) {
        const customers = JSON.parse(response);
        let template = '';
        $.each(customers, function(index, customer) {
          template += `<tr customerId="${ customer.id }"><td>
                      ${customer.id }
                      </td><td><a href="#" class="customer-item">${
                      customer.firstname} ${customer.lastname }
                      </a></td><td>${
                      customer.phone}
                      </td><td><button class="customer-delete btn btn-danger">Delete</button></td></tr>`
                
        });
        //$("#customers").append(template);
        $('#customers').html(template);
      }
    });
  }

  // Get a Single Customer by Id 
  $(document).on('click', '.customer-item', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(element).attr('customerId');
    $.post('customer-single.php', {id}, (response) => {
      const customer = JSON.parse(response);
      $('#firstname').val(customer.firstname);
      $('#lastname').val(customer.lastname);
      $('#phone').val(customer.phone);
      $('#customerId').val(customer.id);
      edit = true;
    });
    e.preventDefault();
  });

  // Delete a Single Customer
  $(document).on('click', '.customer-delete', (e) => {
    if(confirm('Are you sure you want to delete it?')) {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('customerId');
      console.log(id);
      $.post('customer-delete.php', {id}, (response) => {
        fetchCustomers();
      });
    }
  });
});
