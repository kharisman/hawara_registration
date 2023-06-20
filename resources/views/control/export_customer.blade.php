<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Voucher</th>
			<th>Nama Voucher</th>
			<th>Kode Klaim</th>
			<th>Nama</th>
			<th>No HP</th>
			<th>Tanggal Penggunaan Voucher</th>
			<th>Tanggal Klaim</th>
		</tr>
	</thead>
	<tbody>
		@php
		$no = 1;
		@endphp
		@foreach($qr as $voucher)
		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $voucher->code->code }}</td>
			<td>{{ $voucher->gift->name }}</td>
			<td>{{ $voucher->claim_code }}</td>
			<td>{{ $voucher->name }}</td>
			<td>{{ $voucher->phone }}</td>
			<td>{{ $voucher->created_at }}</td>
			<td>@if($voucher->claim_at==NULL) Belum diklaim @else {{ date('d F Y H:i:s',strtotime($voucher->claim_at)) }} @endif</td>
		</tr>
		@endforeach
	</tbody>
</table>