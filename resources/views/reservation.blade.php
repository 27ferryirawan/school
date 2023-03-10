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
                <div style="margin: 50px 50px 0px 150px;">
                    <label>Keterangan Reservasi</label>  
                    <br><br>
                    <table id="reservationTable" style="border-collapse: collapse;">
                    
                        
                    </table>
                </div>
            </div>
            <div class="map-canvas">
                <label>Pilih Meja</label>        
                <canvas id="mapCanvas"></canvas>
            </div>
        </main>
        <footer>
        </footer>        
    </body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
    
    // ctx.fillStyle = "rgba(255, 0, 0, 0)";
    // ctx.fillStyle = "red";
    // const rects = [
    //     {},
    // ];
    
    // rects.forEach(rect => {
    //     ctx.fillRect(rect.x, rect.y, rect.width, rect.height);
    // });

    var isTableSelected = [
        {table: "out1",  tableName: "out 1", price: 15000, isSelected: false, x: 7.8, y: 105.2, width: 10.8, height: 15},
        {table: "out2",  tableName: "out 2", price: 15000, isSelected: false, x: 7.8, y: 79.2, width: 10.8, height: 15},
        {table: "out3",  tableName: "out 3", price: 15000, isSelected: false, x: 7.8, y: 53.2, width: 10.8, height: 15},
        {table: "out4",  tableName: "out 4", price: 15000, isSelected: false, x: 7.8, y: 27.2, width: 10.8, height: 15},
        {table: "out5",  tableName: "out 5", price: 15000, isSelected: false, x: 64.6, y: 16.8, width: 11, height: 14.7},
        {table: "out6",  tableName: "out 6", price: 15000, isSelected: false, x: 85, y: 16.8, width: 11, height: 14.7},
        {table: "out7",  tableName: "out 7", price: 15000, isSelected: false, x: 101.3, y: 56.5, width: 11, height: 14.5},
        {table: "out8",  tableName: "out 8", price: 15000, isSelected: false, x: 101.3, y: 86.7, width: 11, height: 14.5},
        {table: "out9",  tableName: "out 9", price: 15000, isSelected: false, x: 90.5, y: 117, width: 10.8, height: 14.5},
        {table: "out10", tableName: "out 10",price: 15000, isSelected: false, x: 70.3, y: 116.7, width: 10.8, height: 15},
        {table: "out11", tableName: "out 11",price: 15000, isSelected: false, x: 50.1, y: 116.7, width: 10.8, height: 15},
        {table: "out12", tableName: "out 12",price: 15000, isSelected: false, x: 30.1, y: 116.7, width: 10.8, height: 15},
        {table: "long1", tableName: "long 1",price: 15000, isSelected: false, x: 243, y: 79.8, width: 11, height: 48},
        {table: "long2", tableName: "long 2",price: 15000, isSelected: false, x: 121.2, y: 20.8, width: 35.5, height: 15.5},
        {table: "long3", tableName: "long 3",price: 15000, isSelected: false, x: 70.2, y: 68.1, width: 25.2, height: 15.5},
        {table: "long4", tableName: "long 4",price: 15000, isSelected: false, x: 37.2, y: 68.1, width: 25.5, height: 15.5},
        {table: "sofa1", tableName: "sofa 1",price: 15000, isSelected: false, x: 261.2, y: 79.8, width: 11.4, height: 48},
        {table: "sofa2", tableName: "sofa 2",price: 15000, isSelected: false, x: 121.2, y: 117, width: 35.5, height: 15.5},
        {table: "in6",   tableName: "in 6",  price: 15000, isSelected: false, x: 162, y: 17, width: 10.8, height: 14.9},
        {table: "in5",   tableName: "in 5",  price: 15000, isSelected: false, x: 176.2, y: 17, width: 10.7, height: 14.8},
        {table: "in4",   tableName: "in 4",  price: 15000, isSelected: false, x: 190.9, y: 17, width: 11, height: 14.8},
        {table: "in3",   tableName: "in 3",  price: 15000, isSelected: false, x: 205.1, y: 16.9, width: 10.8, height: 14.9},
        {table: "in2",   tableName: "in 2",  price: 15000, isSelected: false, x: 219.6, y: 17, width: 11, height: 14.9},
        {table: "in1",   tableName: "in 1",  price: 15000, isSelected: false, x: 234.2, y: 17, width: 10.8, height: 14.9},
    ];

    function drawOrRemoveSelected(tableId) {
        var isSelected = isTableSelected.find(table => table.table == tableId).isSelected;
        const reservationDateValue = reservationDateInput.value;
        const reservationTimeValue = reservationTimeInput.value;
        
        if(!isSelected){
            var tableData = isTableSelected.find(table => table.table == tableId)
            var xTab = tableData.x
            var yTab = tableData.y
            var widthTab = tableData.width
            var heightTab = tableData.height
            ctx.fillStyle = "rgba(97, 77, 67, 0.7)";
            ctx.fillRect(xTab, yTab, widthTab, heightTab);
            isTableSelected.find(table => table.table == tableId).isSelected = true;
            if(reservationDateValue.length != 0 && reservationTimeValue.length != 0 )ketReservasiChange();
        } else {
            var tableData = isTableSelected.find(table => table.table == tableId)
            var xTab = tableData.x - 2
            var yTab = tableData.y - 2 
            var widthTab = tableData.width + 4
            var heightTab = tableData.height + 4
            ctx.clearRect(xTab, yTab, widthTab, heightTab);
            isTableSelected.find(table => table.table == tableId).isSelected = false;
            if(reservationDateValue.length != 0 && reservationTimeValue.length != 0 )ketReservasiChange();
        }
    }
    canvas.addEventListener('click', function(event) {
        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        if (x >= 24 && x <= 55 && y >= 62 && y <= 95) { 
            //out 4
            var tabId = "out4"
            drawOrRemoveSelected(tabId);
        } else if (x >= 24 && x <= 55 && y >= 119 && y <= 152) {
            //out 3
            var tabId = "out3"
            drawOrRemoveSelected(tabId);
        } else if (x >= 24 && x <= 55 && y >= 176 && y <= 209) {
            //out 2
            var tabId = "out2"
            drawOrRemoveSelected(tabId);
        } else if (x >= 24 && x <= 55 && y >= 233 && y <= 266) {
            //out 1
            var tabId = "out1"
            drawOrRemoveSelected(tabId);
        } else if (x >= 194.3 && x <= 225.3 && y >= 39 && y <= 71) {
            //out 5
            var tabId = "out5"
            drawOrRemoveSelected(tabId);
        } else if (x >= 255.3 && x <= 286 && y >= 39 && y <= 71) {
            //out 6
            var tabId = "out6"
            drawOrRemoveSelected(tabId);
        } else if (x >= 112 && x <= 188 && y >= 151.9 && y <= 183.1) {
            //long 4
            var tabId = "long4"
            drawOrRemoveSelected(tabId);
        } else if (x >= 210 && x <= 287 && y >= 151.9 && y <= 183.1) {
            //long 3
            var tabId = "long3"
            drawOrRemoveSelected(tabId);
        } else if (x >= 304 && x <= 336 && y >= 124.9 && y <= 157.9) {
            //out 7
            var tabId = "out7"
            drawOrRemoveSelected(tabId);
        } else if (x >= 304 && x <= 336 && y >= 191.9 && y <= 223.9) {
            //out 8
            var tabId = "out8"
            drawOrRemoveSelected(tabId);
        } else if (x >= 272 && x <= 303 && y >= 256.9 && y <= 288.9) {
            //out 9
            var tabId = "out9"
            drawOrRemoveSelected(tabId);
        } else if (x >= 211 && x <= 243 && y >= 256.9 && y <= 288.9) {
            //out 10
            var tabId = "out10"
            drawOrRemoveSelected(tabId);
        } else if (x >= 151 && x <= 182 && y >= 256.9 && y <= 288.9) {
            //out 11
            var tabId = "out11"
            drawOrRemoveSelected(tabId);
        } else if (x >= 90 && x <= 122 && y >= 256.9 && y <= 288.9) {
            //out 12
            var tabId = "out12"
            drawOrRemoveSelected(tabId);
        } else if (x >= 364 && x <= 468 && y >= 45.9 && y <= 77.9) {
            //long 2
            var tabId = "long2"
            drawOrRemoveSelected(tabId);
        } else if (x >= 364 && x <= 468 && y >= 257.9 && y <= 289.9) {
            //sofa 2
            var tabId = "sofa2"
            drawOrRemoveSelected(tabId);
        } else if (x >= 485 && x <= 518 && y >= 37.9 && y <= 69.9) {
            //in 6
            var tabId = "in6"
            drawOrRemoveSelected(tabId);
        } else if (x >= 528 && x <= 561 && y >= 37.9 && y <= 69.9) {
            //in 5
            var tabId = "in5"
            drawOrRemoveSelected(tabId);
        } else if (x >= 572 && x <= 604 && y >= 37.9 && y <= 69.9) {
            //in 4
            var tabId = "in4"
            drawOrRemoveSelected(tabId);
        } else if (x >= 616 && x <= 648 && y >= 37.9 && y <= 69.9) {
            //in 3
            var tabId = "in3"
            drawOrRemoveSelected(tabId);
        } else if (x >= 659 && x <= 691 && y >= 37.9 && y <= 69.9) {
            //in 2
            var tabId = "in2"
            drawOrRemoveSelected(tabId);
        } else if (x >= 702 && x <= 734 && y >= 37.9 && y <= 69.9) {
            //in 1
            var tabId = "in1"
            drawOrRemoveSelected(tabId);
        } else if (x >= 728 && x <= 761 && y >= 175.9 && y <= 280.9) {
            //long 1
            var tabId = "long1"
            drawOrRemoveSelected(tabId);
        } else if (x >= 784 && x <= 817 && y >= 175.9 && y <= 280.9) {
            //long 2
            var tabId = "sofa1"
            drawOrRemoveSelected(tabId);
        }
    });
    
    const reservationDateInput = document.getElementById('reservationDate');
    const reservationTimeInput = document.getElementById('reservationTime');
    
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
        var totalPrice = 0;
        isTableSelected.forEach((data) => {
            const reservationDateValue = reservationDateInput.value;
            const reservationTimeValue = reservationTimeInput.value;
            if(data['isSelected']){
                totalPrice += data['price'];
                const row = document.createElement("tr");

                const firstCell = document.createElement("td");
                firstCell.style.width = "300px";
                
                const firstCellLabel1 = document.createElement("label");
                firstCellLabel1.textContent = data['tableName'] + ', ' + reservationDateValue + ' ' + reservationTimeValue;
                
                const firstCellBr = document.createElement("br");

                const firstCellLabel2 = document.createElement("label");
                firstCellLabel2.textContent = 'fee';
                
                firstCell.appendChild(firstCellLabel1);
                firstCell.appendChild(firstCellBr);
                firstCell.appendChild(firstCellLabel2);
                
                const secondCell = document.createElement("td");

                const secondCellBr = document.createElement("br");

                const secondCellLabel1 = document.createElement("label");
                secondCellLabel1.textContent = 'Rp. ' + data['price'];

                secondCell.appendChild(secondCellBr);
                secondCell.appendChild(secondCellLabel1);

                row.appendChild(firstCell);
                row.appendChild(secondCell);

                tableContainer.appendChild(row);
            }
        });
        const row = document.createElement("tr");
        const firstCell = document.createElement("td");
        firstCell.style.width = "300px";
        firstCell.textContent = 'Total';

        const secondCell = document.createElement("td");
        secondCell.textContent = 'Rp. ' + totalPrice;

        row.appendChild(firstCell);
        row.appendChild(secondCell);

        tableContainer.appendChild(row);
    }
</script>
