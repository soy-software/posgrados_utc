{!! $dataTable->table()  !!}
{!! $dataTable->scripts() !!}
<script>
    $('table').on('draw.dt', function() {
			$('[data-toggle="tooltip"]').tooltip();
		})
</script>