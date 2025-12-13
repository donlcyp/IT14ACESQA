# Bulk Transaction Status Update Implementation

## 1. Replace Finance & Transactions Table Section (Lines 1363-1420)

Replace the entire "Transaction Details Table" section with:

```blade
                        <!-- Transaction Details Table -->
                        <div>
                            <div style="font-weight: 600; font-size: 15px; margin-bottom: 8px; display:flex; align-items:center; justify-content:space-between;">
                                <span>Transaction Details</span>
                                <style>
                                    .status-select {
                                        background: transparent;
                                        border: 1px solid var(--gray-300);
                                        border-radius: 6px;
                                        padding: 6px 10px;
                                        font-size: 12px;
                                        color: var(--gray-800);
                                        min-width: 120px;
                                        cursor: pointer;
                                    }
                                    .status-select:focus { outline: 2px solid var(--accent); outline-offset: 1px; }
                                </style>
                            </div>
                            
                            <!-- Bulk Status Update Controls -->
                            @if ($materials && $materials->count() > 0)
                            <div style="display: flex; gap: 12px; margin-bottom: 20px; align-items: center; flex-wrap: wrap;">
                                <select id="bulkStatusSelect" style="padding: 8px 12px; border: 1px solid var(--gray-300); border-radius: 6px; font-size: 13px; min-width: 140px;">
                                    <option value="">-- Change Status To --</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="failed">Failed</option>
                                </select>
                                <button type="button" id="applyBulkStatusBtn" class="btn btn-primary" style="display: none;" onclick="applyBulkTransactionStatus()">
                                    <i class="fas fa-check"></i> Apply to Selected (<span id="selectedTransactionCount">0</span>)
                                </button>
                            </div>
                            @endif
                            
                            @if ($materials && $materials->count() > 0)
                                <div style="overflow-x: auto;">
                                    <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                                        <thead>
                                            <tr style="border-bottom: 2px solid var(--accent); background: var(--sidebar-bg);">
                                                <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); width: 50px;">
                                                    <input type="checkbox" id="selectAllTransactions" onchange="toggleAllTransactions()" style="cursor: pointer; width: 18px; height: 18px;">
                                                </th>
                                                <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--black-1);">Item Description</th>
                                                <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); width: 80px;">Qty</th>
                                                <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1); width: 100px;">Unit Rate</th>
                                                <th style="padding: 12px; text-align: right; font-weight: 600; color: var(--black-1); width: 100px;">Total Cost</th>
                                                <th style="padding: 12px; text-align: center; font-weight: 600; color: var(--black-1); width: 100px;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="transactionTableBody">
                                            @foreach ($materials as $material)
                                                @php
                                                    $itemTotal = ($material->material_cost ?? 0 + $material->labor_cost ?? 0) * ($material->quantity ?? 0);
                                                    $statusColor = match(strtolower($material->status ?? 'pending')) {
                                                        'approved' => ['#dbeafe', '#1e3a8a', '#1e40af'],
                                                        'pending' => ['#fef3c7', '#92400e', '#f59e0b'],
                                                        'failed' => ['#fee2e2', '#991b1b', '#dc2626'],
                                                        default => ['#f3f4f6', '#374151', '#6b7280']
                                                    };
                                                @endphp
                                                <tr style="border-bottom: 1px solid var(--gray-400);" data-transaction-id="{{ $material->id }}">
                                                    <td style="padding: 12px; text-align: center;">
                                                        <input type="checkbox" class="transaction-checkbox" data-material-id="{{ $material->id }}" onchange="updateTransactionSelectionCount()" style="cursor: pointer; width: 18px; height: 18px;">
                                                    </td>
                                                    <td style="padding: 12px; color: var(--black-1);">
                                                        <div style="font-weight: 500; white-space: pre-wrap; line-height: 1.6; font-size: 15px;">{{ $material->item_description ?? 'N/A' }}</div>
                                                        @if($material->category)
                                                            <div style="font-size: 11px; color: var(--gray-600); margin-top: 6px;"><strong>Category:</strong> {{ $material->category }}</div>
                                                        @endif
                                                    </td>
                                                    <td style="padding: 12px; text-align: center; color: var(--gray-700);">{{ $material->quantity ?? 0 }}</td>
                                                    <td style="padding: 12px; text-align: right; color: var(--gray-700);">₱{{ number_format($material->material_cost ?? 0, 2) }}</td>
                                                    <td style="padding: 12px; text-align: right; color: var(--gray-700); font-weight: 600; background: #f9fafb;">₱{{ number_format($itemTotal, 2) }}</td>
                                                    <td style="padding: 12px; text-align: center;">
                                                        <select class="status-select" data-material-id="{{ $material->id }}" onchange="updateMaterialStatus(this.dataset.materialId, this.value)">
                                                            <option value="pending" {{ strtolower($material->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="approved" {{ strtolower($material->status ?? 'pending') === 'approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="failed" {{ strtolower($material->status ?? 'pending') === 'failed' ? 'selected' : '' }}>Failed</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div style="padding: 20px; background: var(--sidebar-bg); border-radius: 6px; text-align: center; color: var(--gray-600);">
                                    <i class="fas fa-chart-line" style="font-size: 24px; margin-bottom: 10px; opacity: 0.5;"></i>
                                    <p>No transactions recorded yet. Add BOQ items to begin tracking finances.</p>
                                </div>
                            @endif
                        </div>
```

## 2. Add JavaScript Functions (at end of file before closing script tag)

Add these functions to your JavaScript section:

```javascript
        // Toggle all transaction checkboxes
        function toggleAllTransactions() {
            const selectAllCheckbox = document.getElementById('selectAllTransactions');
            const checkboxes = document.querySelectorAll('.transaction-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateTransactionSelectionCount();
        }

        // Update transaction selection count and show/hide bulk action button
        function updateTransactionSelectionCount() {
            const checkboxes = document.querySelectorAll('.transaction-checkbox:checked');
            const count = checkboxes.length;
            const countSpan = document.getElementById('selectedTransactionCount');
            const applyBtn = document.getElementById('applyBulkStatusBtn');
            const statusSelect = document.getElementById('bulkStatusSelect');
            
            countSpan.textContent = count;
            
            // Show apply button only if items are selected
            if (count > 0 && statusSelect.value) {
                applyBtn.style.display = 'inline-flex';
            } else {
                applyBtn.style.display = 'none';
            }
        }

        // Update button visibility when status dropdown changes
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('bulkStatusSelect');
            if (statusSelect) {
                statusSelect.addEventListener('change', updateTransactionSelectionCount);
            }
        });

        // Apply bulk status update to selected transactions
        function applyBulkTransactionStatus() {
            const statusSelect = document.getElementById('bulkStatusSelect');
            const newStatus = statusSelect.value;
            
            if (!newStatus) {
                showNotification('Please select a status', 'info');
                return;
            }
            
            const checkboxes = document.querySelectorAll('.transaction-checkbox:checked');
            if (checkboxes.length === 0) {
                showNotification('Please select at least one transaction', 'info');
                return;
            }
            
            const materialIds = Array.from(checkboxes).map(cb => cb.dataset.materialId);
            let completed = 0;
            let failed = 0;
            
            // Update each material
            materialIds.forEach(materialId => {
                fetch(`/projects/{{ $project->id }}/materials/${materialId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to load material data');
                    return response.json();
                })
                .then(material => {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                    if (!csrfToken) throw new Error('CSRF token not found');
                    
                    const formData = new FormData();
                    formData.append('_method', 'PUT');
                    formData.append('_token', csrfToken);
                    formData.append('item_description', material.item_description || '');
                    formData.append('quantity', material.quantity || 1);
                    formData.append('unit', material.unit || '');
                    formData.append('material_cost', material.material_cost || 0);
                    formData.append('labor_cost', material.labor_cost || 0);
                    formData.append('category', material.category || '');
                    formData.append('notes', material.notes || '');
                    formData.append('status', newStatus);
                    
                    return fetch(`/projects/{{ $project->id }}/materials/${materialId}`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });
                })
                .then(response => {
                    if (!response.ok) throw new Error('Update failed');
                    completed++;
                    
                    // Update the UI immediately
                    const row = document.querySelector(`tr[data-transaction-id="${materialId}"]`);
                    if (row) {
                        const select = row.querySelector('.status-select');
                        if (select) {
                            select.value = newStatus;
                            setStatusSelectColor(select);
                        }
                    }
                    
                    // Check if all updates are complete
                    if (completed + failed === materialIds.length) {
                        completeTransactionUpdate(completed, failed, newStatus);
                    }
                })
                .catch(error => {
                    failed++;
                    console.error('Error updating material:', error);
                    
                    if (completed + failed === materialIds.length) {
                        completeTransactionUpdate(completed, failed, newStatus);
                    }
                });
            });
        }

        // Completion handler for bulk transaction status update
        function completeTransactionUpdate(completed, failed, newStatus) {
            const checkboxes = document.querySelectorAll('.transaction-checkbox:checked');
            checkboxes.forEach(cb => cb.checked = false);
            
            document.getElementById('selectAllTransactions').checked = false;
            document.getElementById('bulkStatusSelect').value = '';
            updateTransactionSelectionCount();
            
            if (failed === 0) {
                showNotification(`Successfully updated ${completed} transaction(s) to ${newStatus}`, 'success', true);
            } else {
                showNotification(`Updated ${completed} transaction(s), but ${failed} failed`, 'error');
            }
        }
```

## Key Features:

- **Select All Checkbox**: Toggle all transactions at once
- **Individual Checkboxes**: Select specific transactions to update
- **Bulk Status Dropdown**: Choose the new status to apply
- **Apply Button**: Appears only when items are selected and status is chosen
- **Live Count**: Shows how many items are selected
- **Immediate UI Update**: Rows update with new status color immediately
- **Success Feedback**: Toast notification confirms bulk update completion
- **Automatic Refresh**: Page reloads after bulk update to sync data
