@extends('admin.layouts.app')
@section('title', 'Properties Create | Lumbini Innovate')
@section('content')
    <div class="container-fluid py-3">
        <div class="mb-4 card-header">
            <h4 class="mb-0 text-muted" style="font-size: 12px;">
                <a href="" class="text-decoration-none text-muted">Properties | Create | #</a>
            </h4>
        </div>
        <form id="propertyRegistrationForm" method="POST" action="{{ route('admin.properties.store') }}"
              enctype="multipart/form-data">
            @csrf
            @include('admin.properties.form')
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle loan details
            const hasLoanCheckbox = document.getElementById('has_loan');
            const loanDetails = document.getElementById('loan-details');

            hasLoanCheckbox.addEventListener('change', function() {
                loanDetails.style.display = this.checked ? 'block' : 'none';
            });

            // Toggle total plots field
            const isSubdividedCheckbox = document.getElementById('is_subdivided');
            const totalPlotsGroup = document.getElementById('total-plots-group');

            isSubdividedCheckbox.addEventListener('change', function() {
                totalPlotsGroup.style.display = this.checked ? 'block' : 'none';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tax repeater
            const taxRepeater = {
                index: 0,
                container: document.querySelector('.tax-items-container'),
                template: document.querySelector('.tax-item-template'),

                addItem: function() {
                    const newIndex = this.index++;
                    const newItem = this.template.innerHTML.replace(/__INDEX__/g, newIndex);

                    const itemDiv = document.createElement('div');
                    itemDiv.innerHTML = newItem;
                    this.container.appendChild(itemDiv.firstElementChild);

                    // Initialize file input for this item
                    const fileInput = itemDiv.querySelector('.custom-file-input');
                    fileInput.addEventListener('change', function(e) {
                        const fileName = e.target.files[0]?.name || 'Choose file';
                        e.target.nextElementSibling.textContent = fileName;
                    });
                },

                removeItem: function(button) {
                    button.closest('.tax-item').remove();
                },

                init: function() {
                    // Add first empty item
                    this.addItem();

                    // Add event listener for the "Add" button
                    document.getElementById('add-tax-item').addEventListener('click', () => this.addItem());

                    // Delegated event listener for remove buttons
                    this.container.addEventListener('click', (e) => {
                        if (e.target.classList.contains('remove-tax-item')) {
                            this.removeItem(e.target);
                        }
                    });
                }
            };

            taxRepeater.init();

            // Initialize main document upload
            const documentInput = document.getElementById('documents');
            const fileList = document.querySelector('.file-list');

            documentInput.addEventListener('change', function() {
                fileList.innerHTML = ''; // Clear previous list

                if (this.files.length > 0) {
                    Array.from(this.files).forEach((file, index) => {
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                        listItem.innerHTML = `
                    <span>${file.name} (${(file.size / 1024 / 1024).toFixed(2)}MB)</span>
                    <button type="button" class="btn btn-sm btn-danger remove-file" data-index="${index}">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                        fileList.appendChild(listItem);
                    });
                } else {
                    fileList.innerHTML = '<li class="list-group-item text-muted">No files selected</li>';
                }
            });

            // Remove file from preview (note: this doesn't actually remove from FormData)
            fileList.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-file') || e.target.closest('.remove-file')) {
                    const button = e.target.classList.contains('remove-file') ? e.target : e.target.closest('.remove-file');
                    button.closest('li').remove();
                }
            });

            // Initialize Bootstrap custom file input
            document.querySelectorAll('.custom-file-input').forEach(input => {
                input.addEventListener('change', function(e) {
                    const fileName = e.target.files[0]?.name || 'Choose file';
                    e.target.nextElementSibling.textContent = fileName;
                });
            });

            // [Keep your existing JavaScript for conditional fields]
        });
    </script>
@endsection
