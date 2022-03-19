<script>
        function docReady(fn) {
            // see if DOM is already available
            if (document.readyState === "complete" || document.readyState === "interactive") {
                // call on next available tick
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }
        
        /** Ugly function to write the results to a table dynamically. */
        function printScanResultPretty(codeId, decodedText, decodedResult) {
            let resultSection = document.getElementById('scanned-result');
            let tableBodyId = "scanned-result-table-body";
            if (!document.getElementById(tableBodyId)) {
                let table = document.createElement("table");
                table.className = "styled-table";
                table.style.width = "40%";
                resultSection.appendChild(table);
        
                let theader = document.createElement('thead');
                let trow = document.createElement('tr');
                let th1 = document.createElement('td');
                th1.innerText = "";
                let th2 = document.createElement('td');
                th2.innerText = "";
                let th3 = document.createElement('td');
                th3.innerText = "";
              
                theader.appendChild(trow);
                table.appendChild(theader);
        
                let tbody = document.createElement("tbody");
                tbody.id = tableBodyId;
                table.appendChild(tbody);
            }
        
            let tbody = document.getElementById(tableBodyId);
            let trow = document.createElement('tr');
            let td1 = document.createElement('td');
            td1.innerText = `${codeId}`;
            let td2 = document.createElement('td');
            td2.innerText = `${decodedResult.result.format.formatName}`;
            let td3 = document.createElement('td');
            td3.innerText = `${decodedText}`;
            trow.appendChild(td1);
            trow.appendChild(td2);
            trow.appendChild(td3);
            tbody.appendChild(trow);
        }
        
        docReady(function() {
            hljs.initHighlightingOnLoad();
            var lastMessage;
            var codeId = 0;
           
            function onScanSuccess(decodedText, decodedResult) {
                /**
                 * If you following the code example of this page by looking at the
                 * source code of the demo page - good job!!
                 * 
                 * Tip: update this function with a success callback of your choise.
                 */
                if (lastMessage !== decodedText) {
                    lastMessage = decodedText;
                    printScanResultPretty("", decodedText, decodedResult);
                    ++codeId;
    
                }
            }
        
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", 
                { 
                    fps: 5,
                    qrbox: { width: 300, height: 300 },
                    // Important notice: this is experimental feature, use it at your
                    // own risk. See documentation in
                    // mebjas@/html5-qrcode/src/experimental-features.ts
                    experimentalFeatures: {
                        useBarCodeDetectorIfSupported: true
                    },
                    rememberLastUsedCamera: true
                });
            html5QrcodeScanner.render(onScanSuccess);
        });
        

        </script>
     
</head>
<body>
    <?php
    $isbn="";
    $infos['titre']="";
    $infos['auteur']="";
    $infos['publication']="";?>
<script>
function hello() {
   var myTable = document.getElementsByTagName('table')[0];
   var myTr = myTable.getElementsByTagName('tr')[1];
   var myTd = myTr.getElementsByTagName('td')[2];
   var lastVar = myTd.innerHTML;
   document.getElementById("isbn").value = lastVar;
}
</script>
<div id="reader"width=" 300px" height="300px"></div>
 
    <style>
    #reader {
        width: 300px;
        background-color:grey;
    }
    @media(max-width: 600px) {
        #reader {
            width: 300px;
        }
    }
    .empty {
        display: block;
        width: 100%;
        height: 20px;
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    
    .alert-info {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }
    
    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
    </style>
   
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align: center;margin-bottom: 20px;">
                <div id="reader" style="display: inline-block;"></div>
                <div class="empty"></div>
                <div id="scanned-result"></div>
            </div>
        </div>
    </div>