<!DOCTYPE html>
<html>
    <head>
        <title>Reservation</title>
    </head>
    <body>
        <header>
            @include('layouts/navbar')
        </header>
        <main>
            <div style="display: flex;">
                <div>
                    <div class="date-input">
                        <label>Pilih Tanggal</label>        
                        <input type="text" id="reservationDate" name="reservationDate">
                    </div>
                    <div class="time-input">
                        <label>Pilih Waktu</label>        
                        <input type="text" id="reservationTime" name="reservationTime">
                    </div>
                </div>
                <div class="reserve-div">
                    <label class="ket-reserv-label">Keterangan Reservasi</label>  
                    <br>
                    <table id="reservationTable" style="border-collapse: collapse;">
                    </table>
                    <button class="payment-button" onclick="showModal()">Payment</button>
                </div>
            </div>
            <div class="map-canvas">
                <label>Pilih Meja</label>        
                <canvas id="mapCanvas"></canvas>
            </div>
            <div id="modal" class="modal">
                <div class="modal-content">
                    <h2>Confirm Payment</h2>
                    <p>Are you sure you want to make the payment?</p>
                    <button class="confirm-button" onclick="makePayment()">Confirm</button>
                    <button class="cancel-button" onclick="hideModal()">Cancel</button>
                </div>
            </div>
            
            <div id="paymentModal" class="modal">
                <div class="payment modal-content">
                    <div class="bg-color">
                        <div class="payment-header">
                            <img src="{{ asset('images/samanko.png') }}" style="width: 100px; height: 80px;">
                        </div>
                        <div class="line">
                            <div class="rectangle">
                                <div class="label-style">
                                    <p>Total</p>
                                    <span id="totalPrice"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="payment-table">
                        @foreach($paymentTypes as $paymentType)
                            <label id="paymentTypeName">{{ $paymentType->payment_type_name }}</label>
                            <table>
                                    @foreach($payments[$paymentType->id] as $payment)
                                    <tr>
                                        <td>
                                            @if(!$payment->is_available)
                                                <div style="display: flex; flex-direction: row; height: 50px;">
                                            @else
                                                <div data-paymentTypeId="{{ $payment->payment_type_id }}" data-paymentId="{{ $payment->id }}" style="display: flex; flex-direction: row; height: 50px;" onclick="showQRModal(this)">
                                            @endif
                                                <img src="{{ $payment->logo_path }}" style="width: 50px; height: 50px;">
                                                <div id="payname-balance" style="display: flex; flex-direction: column; margin-left: 15px">
                                                    @if($payment->payment_type_id == 2)
                                                        <div class="paymentTypeName"> {{ $payment->payment_name }} </div>
                                                        <div>Rp {{ number_format($payment->balance, 0, ',', '.') }},00</div>
                                                    @else
                                                        <div style="display: flex; align-items: center; height: 100%;">
                                                            <div class="paymentTypeName"> {{ $payment->payment_name }} </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div style="display: flex; align-items: center; height: 100%; margin-left: auto;">
                                                    @if(!$payment->is_available)
                                                        <img class="warning-hover" src="{{ asset('images/warning.svg') }}" style="width: 25px; height: 25px;" {{ Popper::size('large')->pop('Payment is not available   !');}}>
                                                    @else
                                                        <img src="{{ asset('images/right-arrow.svg') }}" style="width: 20px; height: 20px; margin-right: 4px;">
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="successOrFailedModal" class="modal">
                <div class="modal-content">
                    <p id="successOrFailedText" class="ajax-label"></p>
                    <button class="confirm-button" onclick="hideSuccessOrFailedModal()">Confirm</button>
                </div>
            </div>
            <div id="QRModal" class="modal">
                <div class="modal-content">
                    <p class="ajax-label">QRIS</p>
                    <img src="{{ asset('images/samanko_qr.png') }}">
                    <button class="confirm-button" onclick="hideQRModal()">Confirm</button>
                </div>
            </div>
        </main>
        @include('layouts/footer')      
        @include('popper::assets')
    </body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</html>

<script>

    flatpickr("#reservationDate", {
        dateFormat: "d M Y", 
        // maxDate: "today", 
        minDate: "today",
    });

    flatpickr("#reservationTime", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        maxTime: "18:00",
        minTime: "11:00"
    });

    const canvas = document.getElementById('mapCanvas');
    const ctx = canvas.getContext('2d');
    const modal = document.getElementById("modal");
    const successOrFailedModal = document.getElementById("successOrFailedModal");
    const paymentModal = document.getElementById("paymentModal");
    const QRModal = document.getElementById("QRModal");
    const paymentButton = document.querySelector(".payment-button");
    const reserveLabel = document.querySelector(".ket-reserv-label");
    const reservationDateInput = document.getElementById('reservationDate');
    const reservationTimeInput = document.getElementById('reservationTime');
    var tableDetail = {!! $tableDetail !!}; 
    var fetchTableDetail = [];
    var fixTablePaymentData = [];
    var totalPrice = 0;
    var paymentId = "";
    var paymentTypeId = "";
    paymentButton.style.display = "none";
    reserveLabel.style.display = "none";
    
    
    // ctx.fillStyle = "rgba(255, 0, 0, 0)";
    // ctx.fillStyle = "rgba(97, 77, 67, 0.7)";
    // const rects = [
    //     {table: "out1",  tableName: "out 1", price: 15000, isSelected: false, x: 8, y: 102.9, width: 10.5, height: 12.5},
    // ];
    
    // rects.forEach(rect => {
    //     ctx.fillRect(rect.x, rect.y, rect.width, rect.height);
    // });

    var isTableSelected = [
        {table: "out1",  isSelected: false, x: 8, y: 102.9, width: 10.5, height: 12.5},
        {table: "out2",  isSelected: false, x: 8, y: 79.3, width: 10.5, height: 12.5},
        {table: "out3",  isSelected: false, x: 8, y: 56.2, width: 10.5, height: 12.5},
        {table: "out4",  isSelected: false, x: 8, y: 32.7, width: 10.5, height: 12.5},
        {table: "out5",  isSelected: false, x: 64.8, y: 23.3, width: 10.5, height: 12.5},
        {table: "out6",  isSelected: false, x: 85.2, y: 23.3, width: 10.5, height: 12.5},
        {table: "out7",  isSelected: false, x: 101.6, y: 59.2, width: 10.5, height: 12.5},
        {table: "out8",  isSelected: false, x: 101.6, y: 86.2, width: 10.5, height: 12.5},
        {table: "out9",  isSelected: false, x: 90.5, y: 113.2, width: 10.8, height: 12.5},
        {table: "out10", isSelected: false, x: 70.5, y: 113.2, width: 10.5, height: 12.5},
        {table: "out11", isSelected: false, x: 50.4, y: 113.2, width: 10.5, height: 12.5},
        {table: "out12", isSelected: false, x: 30.3, y: 113.2, width: 10.5, height: 12.5},
        {table: "long1", isSelected: false, x: 243, y: 79.6, width: 11, height: 42.5},
        {table: "long2", isSelected: false, x: 121.3, y: 26.3, width: 35, height: 14},
        {table: "long3", isSelected: false, x: 70.2, y: 69.3, width: 25.5, height: 14},
        {table: "long4", isSelected: false, x: 37.2, y: 69.3, width: 25.5, height: 14},
        {table: "sofa1", isSelected: false, x: 261.6, y: 79.6, width: 11, height: 42.5},
        {table: "sofa2", isSelected: false, x: 121.3, y: 113, width: 35.3, height: 14},
        {table: "in6",   isSelected: false, x: 161.9, y: 23.1, width: 10.7, height: 12.9},
        {table: "in5",   isSelected: false, x: 176.2, y: 23.1, width: 10.7, height: 12.9},
        {table: "in4",   isSelected: false, x: 190.9, y: 23.1, width: 10.7, height: 12.9},
        {table: "in3",   isSelected: false, x: 205.1, y: 23.1, width: 10.7, height: 12.9},
        {table: "in2",   isSelected: false, x: 219.6, y: 23.1, width: 10.7, height: 12.9},
        {table: "in1",   isSelected: false, x: 234.2, y: 23.1, width: 10.7, height: 12.9},
    ];

    function clearAll(firstInit){
        reservationDateInput.value = "";
        reservationTimeInput.value = "";
        var tableContainer = document.getElementById("reservationTable");
        while (tableContainer.firstChild) {
            tableContainer.removeChild(tableContainer.firstChild);
        }
        
        paymentButton.style.display = "none";
        reserveLabel.style.display = "none";
        
        if(firstInit){
            for (var i = 0; i < tableDetail.length; i++) {
                if(tableDetail[i].id == isTableSelected.find(table => table.table == tableDetail[i].id).table){
                    isTableSelected.find(table => table.table == tableDetail[i].id).tableName = tableDetail[i].table_name;
                    isTableSelected.find(table => table.table == tableDetail[i].id).price = tableDetail[i].price;
                    isTableSelected.find(table => table.table == tableDetail[i].id).status = tableDetail[i].status;
                    drawOrRemoveSelected(tableDetail[i].id, true);
                }
            }
        }
        else{
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            getTableDetailData();
        }
    }

    clearAll(true);

    function drawOrRemoveSelected(tableId, firstInit) {
        var isSelected = isTableSelected.find(table => table.table == tableId).isSelected;
        var isAvailable = isTableSelected.find(table => table.table == tableId).status == 0 ? true : false;
        
        const reservationDateValue = reservationDateInput.value;
        const reservationTimeValue = reservationTimeInput.value;
        
        if(isAvailable && !firstInit){
            if(!isSelected){
                var tableData = isTableSelected.find(table => table.table == tableId)
                var xTab = tableData.x
                var yTab = tableData.y
                var widthTab = tableData.width
                var heightTab = tableData.height
                ctx.fillStyle = "rgba(0, 255, 0, 0.4)";
                ctx.fillRect(xTab, yTab, widthTab, heightTab);
                isTableSelected.find(table => table.table == tableId).isSelected = true;
                
            } else {
                var tableData = isTableSelected.find(table => table.table == tableId)
                var xTab = tableData.x - 2
                var yTab = tableData.y - 2 
                var widthTab = tableData.width + 4
                var heightTab = tableData.height + 4
                ctx.clearRect(xTab, yTab, widthTab, heightTab);
                isTableSelected.find(table => table.table == tableId).isSelected = false;
            }
            if(reservationDateValue.length != 0 && reservationTimeValue.length != 0 )
            ketReservasiChange();
        } else if(!isAvailable && firstInit){
            var tableData = isTableSelected.find(table => table.table == tableId)
            var xTab = tableData.x
            var yTab = tableData.y
            var widthTab = tableData.width
            var heightTab = tableData.height
            ctx.fillStyle = "rgba(255, 0, 0, 0.4)";
            ctx.fillRect(xTab, yTab, widthTab, heightTab);
        }
    }
    
    canvas.addEventListener('click', function(event) {
        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        // console.log(x + ", " + y);
        if (x >= 34 && x <= 80 && y >= 114.9 && y <= 160.9) { 
            //out 4
            var tabId = "out4"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 34 && x <= 80 && y >= 197.9 && y <= 242.9) {
            //out 3
            var tabId = "out3"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 34 && x <= 80 && y >= 280.9 && y <= 326.9) {
            //out 2
            var tabId = "out2"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 34 && x <= 80 && y >= 361.9 && y <= 407.9) {
            //out 1
            var tabId = "out1"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 280 && x <= 327 && y >= 81.9 && y <= 126.9) {
            //out 5
            var tabId = "out5"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 368 && x <= 414 && y >= 81.9 && y <= 126.9) {
            //out 6
            var tabId = "out6"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 161 && x <= 271 && y >= 243.9 && y <= 291.9) {
            //long 4
            var tabId = "long4"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 304 && x <= 414 && y >= 243.9 && y <= 291.9) {
            //long 3
            var tabId = "long3"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 440 && x <= 486 && y >= 207.9 && y <= 253.9) {
            //out 7
            var tabId = "out7"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 440 && x <= 486 && y >= 302.9 && y <= 348.9) {
            //out 8
            var tabId = "out8"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 393 && x <= 438 && y >= 398.9 && y <= 443.9) {
            //out 9
            var tabId = "out9"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 305 && x <= 351 && y >= 398.9 && y <= 443.9) {
            //out 10
            var tabId = "out10"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 218 && x <= 264 && y >= 398.9 && y <= 443.9) {
            //out 11
            var tabId = "out11"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 131 && x <= 177 && y >= 398.9 && y <= 443.9) {
            //out 12
            var tabId = "out12"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 526 && x <= 677 && y >= 92.9 && y <= 140.9) {
            //long 2
            var tabId = "long2"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 526 && x <= 677 && y >= 298.9 && y <= 445.9) {
            //sofa 2
            var tabId = "sofa2"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 701 && x <= 748 && y >= 81.9 && y <= 127.9) {
            //in 6
            var tabId = "in6"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 763 && x <= 810 && y >= 81.9 && y <= 127.9) {
            //in 5
            var tabId = "in5"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 826 && x <= 873 && y >= 81.9 && y <= 127.9) {
            //in 4
            var tabId = "in4"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 889 && x <= 935 && y >= 81.9 && y <= 127.9) {
            //in 3
            var tabId = "in3"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 951 && x <= 997 && y >= 81.9 && y <= 127.9) {
            //in 2
            var tabId = "in2"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 1015 && x <= 1061 && y >= 81.9 && y <= 127.9) {
            //in 1
            var tabId = "in1"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 1053 && x <= 1100 && y >= 281.9 && y <= 431.9) {
            //long 1
            var tabId = "long1"
            drawOrRemoveSelected(tabId, false);
        } else if (x >= 1133 && x <= 1181 && y >= 281.9 && y <= 431.9) {
            //long 2
            var tabId = "sofa1"
            drawOrRemoveSelected(tabId, false);
        }
    });
    
    reservationDateInput.addEventListener('change', (event) => {
        const reservationDateValue = reservationDateInput.value;
        const reservationTimeValue = reservationTimeInput.value;
        if(reservationDateValue.length != 0 && reservationTimeValue.length != 0 )
        ketReservasiChange();
    });

    reservationTimeInput.addEventListener('change', (event) => {
        const reservationDateValue = reservationDateInput.value;
        const reservationTimeValue = reservationTimeInput.value;
        if(reservationDateValue.length != 0 && reservationTimeValue.length != 0 )
        ketReservasiChange();
    });

    function ketReservasiChange(){
        var tableContainer = document.getElementById("reservationTable");
        while (tableContainer.firstChild) {
            tableContainer.removeChild(tableContainer.firstChild);
        }
        totalPrice = 0;
        fixTablePaymentData = [];
        var countSelectedData = 0;
        isTableSelected.forEach((data) => {
            if(data['isSelected']){
                const reservationDateValue = reservationDateInput.value;
                const reservationTimeValue = reservationTimeInput.value;
                var concatDate = reservationDateValue + ' ' + reservationTimeValue;
                fixTablePaymentData.push({
                    table_id: data.table,
                    fee: data.price,
                    reservation_date: concatDate
                });
                countSelectedData += 1;
                totalPrice += data['price'];
                const row = document.createElement("tr");

                const firstCell = document.createElement("td");
                firstCell.style.width = "300px";
                
                const firstCellLabel1 = document.createElement("label");
                firstCellLabel1.textContent = data['tableName']
                
                const firstCellBr = document.createElement("br");

                const firstCellLabel2 = document.createElement("label");
                firstCellLabel2.textContent = 'fee';
                
                firstCell.appendChild(firstCellLabel1);
                firstCell.appendChild(firstCellBr);
                firstCell.appendChild(firstCellLabel2);
                
                const secondCell = document.createElement("td");

                const secondCellBr = document.createElement("br");

                const secondCellLabel1 = document.createElement("label");
                secondCellLabel1.textContent = data['price'].toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

                secondCell.appendChild(secondCellBr);
                secondCell.appendChild(secondCellLabel1);

                row.appendChild(firstCell);
                row.appendChild(secondCell);

                tableContainer.appendChild(row);
            }
        });
        if(countSelectedData > 0){
            const row = document.createElement("tr");
            const firstCell = document.createElement("td");
            firstCell.style.width = "300px";
            firstCell.textContent = 'Total';

            const secondCell = document.createElement("td");
            secondCell.textContent = totalPrice.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

            row.appendChild(firstCell);
            row.appendChild(secondCell);

            tableContainer.appendChild(row);
            paymentButton.style.display = "block";
            reserveLabel.style.display = "block";
        } else {
            paymentButton.style.display = "none";
            reserveLabel.style.display = "none";
        }
    }

    function showModal() {
        modal.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function hideModal() {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }

    function showSuccessOrFailedModal() {
        const reservationDateValue = reservationDateInput.value;
        const reservationTimeValue = reservationTimeInput.value;
        var concatDate = reservationDateValue + ' ' + reservationTimeValue;
        $.ajax({
            url: '{{ route("insert-payment") }}',
            type: 'POST',
            data: {
                PaymentDetail: fixTablePaymentData,
                PaymentDate: concatDate,
                PaymentTotalFee: totalPrice,
                PaymentTypeId: paymentTypeId,
                PaymentId: paymentId,
                CreatedBy: '{{ Auth::user()->id}}',
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                document.getElementById("successOrFailedText").innerHTML = "Reservation Success!";
            },
            error: function(xhr, status, error) {
                document.getElementById("successOrFailedText").innerHTML = "Reservation Failed!";
            }
        })
        successOrFailedModal.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function hideSuccessOrFailedModal() {
        successOrFailedModal.style.display = "none";
        document.body.style.overflow = "auto";
        clearAll(false);
    }

    function showPaymentModal() {
        const spanElement = document.getElementById('totalPrice');
        spanElement.textContent = totalPrice.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        paymentModal.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function hidePaymentModal() {
        paymentModal.style.display = "none";
        document.body.style.overflow = "auto";
    }

    function showQRModal(div) {
        paymentTypeId = div.dataset.paymenttypeid;
        paymentId = div.dataset.paymentid;
        hidePaymentModal()
        QRModal.style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function hideQRModal() {
        QRModal.style.display = "none";
        document.body.style.overflow = "auto";
        showSuccessOrFailedModal()
    }

    function getTableDetailData() {
        $.ajax({
            url: '/reservation/getTableDetailData', 
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    if(data[i].id == isTableSelected.find(table => table.table == data[i].id).table){
                        isTableSelected.find(table => table.table == tableDetail[i].id).status = data[i].status;
                        isTableSelected.find(table => table.table == tableDetail[i].id).isSelected = false
                        drawOrRemoveSelected(data[i].id, true);
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to get tableDetail data:', errorThrown);
            }
        });
    }

    function makePayment() {
        hideModal();
        showPaymentModal()
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            hideModal();
        }
        if (event.target == successOrFailedModal) {
            hideSuccessOrFailedModal();
        }
        if (event.target == paymentModal) {
            hidePaymentModal();
        }
        if (event.target == QRModal) {
            hideQRModal();
        }
    }

</script>
