<div class="card">
    <div class="card-header">
        <h6 class="card-title">Export Alat Tulis Stock</h6>
        <button class="btn btn-link" id="expandButton" data-bs-toggle="collapse"
            data-bs-target="#cardBodyContent">Expand</button>

    </div>
    <div class="card-body collapse" id="cardBodyContent">
        <p>Export the current in stock of alat tulis</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Export Type</th>
                    <th></th>
                </tr>
            </thead>
            <tr>
                <td>
                    <select class="form-select" id="exportType">
                        <option value="excel">Excel</option>
                        <option value="pdf">Pdf</option>
                    </select>
                </td>
                <td class="text-end" width="20%">
                    <a id="exportLink" class="btn btn-outline-success waves-effect" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export"
                            width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3">
                            </path>
                        </svg>
                        <span>Export</span>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>
