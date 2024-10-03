@extends('Admin.don-hang.show')
@section('noidung')
    <div class="container-danhmuc main-data mt-5">
        <form action="{{ route('admin.updateStatus') }}" method="post">
            @csrf
            <h2 class="mb-4">{{ $title }}</h2>
            <div class="table-responsive">
                <table id="table_js" class="table table-striped" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên khác hàng</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donhangedits as $donhangedit)
                            <tr>
                                <input type="hidden" value="{{ $donhangedit->id_donhang }}" name="id_donhang">
                                <td>{{ $donhangedit->id_donhang }}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>{{ $donhangedit->sanpham->tensanpham }}</td>
                                <td>{{ \App\Helpers\Helper::formatVND($donhangedit->gia) }}</td>
                                <td>{{ $donhangedit->trangthais->tentrangthai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <h3><b><label for="trangthai">Trạng thái</label></b></h3>

                {{-- Kiểm tra nếu trạng thái chưa được chọn --}}
                @foreach ($trangthais as $trangthai)
                    {{-- Lặp qua tất cả đơn hàng để kiểm tra trạng thái --}}
                    @php
                        $isChecked = false;
                    @endphp
                    @foreach ($donhangedits as $donhangedit)
                        @if ($donhangedit->id_trangthai === $trangthai->id_trangthai)
                            @php
                                $isChecked = true; // Đánh dấu trạng thái đã được chọn
                                break; // Dừng vòng lặp nếu trạng thái đã được tìm thấy
                            @endphp
                        @endif
                    @endforeach

                    @if (in_array($trangthai->id_trangthai, [0]))
                        <label for="">{{ $trangthai->tentrangthai }}</label> {{-- Hiển thị tên trạng thái nếu nó nằm trong danh sách 6, 7, 8 --}}
                    @else
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="id_trangthai"
                                value="{{ $trangthai->id_trangthai }}" {{ $isChecked ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="{{ $trangthai->id_trangthai }}">{{ $trangthai->tentrangthai }}</label>
                        </div>
                    @endif
                @endforeach

                {{-- Hiển thị nút lưu nếu trạng thái không nằm trong danh sách 6, 7, 8 --}}
                @if (!collect($donhangedits)->pluck('id_trangthai')->intersect([6, 7, 8])->isNotEmpty())
                    <button type="submit" class="btn btn-primary mt-4">Lưu</button>
                @endif
            </div>

        </form>
    </div>
@endsection
