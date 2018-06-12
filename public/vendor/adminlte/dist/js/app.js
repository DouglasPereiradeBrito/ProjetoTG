$(document).ready(function () {
    $('#daterangeCriado-btn').daterangepicker({
          ranges   : {
            'Hoje'       : [moment(), moment()],
            'Ontem'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
            'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
            'Este Mês'  : [moment().startOf('month'), moment().endOf('month')],
            'Mês Passado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          //$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          $('#criado').val(start.format('DD-M-YYYY') + ' - ' + end.format('DD-M-YYYY'));
        });

    $('#daterangeAtualizado-btn').daterangepicker({
        ranges   : {
            'Hoje'       : [moment(), moment()],
            'Ontem'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
            'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
            'Este Mês'  : [moment().startOf('month'), moment().endOf('month')],
            'Mês Passado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
        },
        function (start, end) {
        //$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //$('#atualizado').val(start.format('YYYY-M-DD') + ' - ' + end.format('YYYY-M-DD'));
            $('#atualizado').val(start.format('DD-M-YYYY') + ' - ' + end.format('DD-M-YYYY'));
        });

    $('.select2').select2(); 
    $("#fone").inputmask("(99) 99999-9999");
    $("#cpf").inputmask("999.999.999-**");
})