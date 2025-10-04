$(document).ready(function() {
    // Editable field updates
    $(document).on('blur', '.editable-field', function() {
        var $this = $(this);
        var field = $this.data('field');
        var model = $this.data('model');
        var id = $this.data('id');
        var value = $this.html();

        if (!field || !model || !id || value === $this.data('last-value')) {
            return;
        }

        $this.data('last-value', value);

        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var data = {
            _token: csrfToken,
            model: model,
            id: id,
            field: field,
            value: value
        };

        // If updating a list item (e.g., items.9), send the entire items array
        if (field.includes('items.') || field.includes('payment_terms.') || field.includes('signature_area.')) {
            var $list = $this.closest('.editable-list');
            var listField = field.split('.').slice(0, -1).join('.'); // e.g., items or payment_terms
            var items = [];
            $list.find('.list-item .editable-field').each(function() {
                items.push($(this).html());
            });
            data.field = listField; // Send the base field (e.g., items)
            data.value = items; // Send the entire array
        }

        $.ajax({
            url: '/proposal/update-field',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function(response) {
                console.log('Update successful:', response);
                $this.addClass('saved').delay(1000).queue(function() {
                    $(this).removeClass('saved').dequeue();
                });
            },
            error: function(xhr) {
                console.error('Update failed:', xhr);
                alert('Failed to save changes: ' + (xhr.responseJSON?.error || 'Unknown error'));
            }
        });
    });

    // Store initial values
    $('.editable-field').each(function() {
        $(this).data('last-value', $(this).html());
    });

    // Add list item
    $(document).on('click', '.add-item', function() {
        var $list = $(this).closest('.editable-list');
        var $item = $(this).closest('.list-item');
        var sectionId = $list.data('id');
        var field = $list.data('field');
        var index = $item.index();
        var $referenceItem = $item; // Fix: Copy from the current item

        var newContent = $referenceItem.find('.editable-field').html() || 'New Item';
        var newIndex = index + 1;

        // Insert new item
        var $newItem = $(`
            <li class="list-item">
                <span contenteditable="true" class="editable-field" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}">${newContent}</span>
                <span class="list-actions">
                    <i class="fas fa-plus add-item" title="Add Item"></i>
                    <i class="fas fa-trash remove-item" title="Remove Item"></i>
                </span>
            </li>
        `);
        $newItem.find('.editable-field').data('last-value', newContent); // Fix: Set initial last-value for new field
        $item.after($newItem);

        // Update backend
        updateList($list);
    });

    // Remove list item
    $(document).on('click', '.remove-item', function() {
        var $list = $(this).closest('.editable-list');
        var $item = $(this).closest('.list-item');
        var count = $list.find('.list-item').length;

        if (count <= 1) {
            alert('Cannot remove the last item.');
            return;
        }

        $item.remove();
        updateList($list);
    });

    // Add table row
    $(document).on('click', '.add-row', function() {
        var $table = $(this).closest('.editable-table');
        var $row = $(this).closest('.table-row');
        var sectionId = $table.data('id');
        var field = $table.data('field');
        var index = $row.index();
        var $referenceRow = $row; // Fix: Copy from the current row

        var newData = {
            functionality: $referenceRow.find('td').eq(0).html() || 'New Functionality',
            frontend_price: $referenceRow.find('td').eq(1).html() || '',
            backend_price: $referenceRow.find('td').eq(2).html() || '',
            note: $referenceRow.find('td').eq(3).html() || ''
        };
        var newIndex = index + 1;

        // Insert new row
        var $newRow = $(`
            <tr class="table-row">
                <td contenteditable="true" class="editable-field" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}.functionality">${newData.functionality}</td>
                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}.frontend_price">${newData.frontend_price}</td>
                <td contenteditable="true" class="editable-field price-highlight" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}.backend_price">${newData.backend_price}</td>
                <td contenteditable="true" class="editable-field" data-model="section" data-id="${sectionId}" data-field="${field}.${newIndex}.note">${newData.note}</td>
                <td class="table-actions">
                    <i class="fas fa-plus add-row" title="Add Row"></i>
                    <i class="fas fa-trash remove-row" title="Remove Row"></i>
                </td>
            </tr>
        `);
        $newRow.find('.editable-field').each(function() {
            $(this).data('last-value', $(this).html()); // Fix: Set initial last-value for new fields
        });
        $row.after($newRow);

        // Update backend
        updateTable($table);
    });

    // Remove table row
    $(document).on('click', '.remove-row', function() {
        var $table = $(this).closest('.editable-table');
        var $row = $(this).closest('.table-row');
        var count = $table.find('.table-row').length;

        if (count <= 1) {
            alert('Cannot remove the last row.');
            return;
        }

        $row.remove();
        updateTable($table);
    });

    // Add timeline item
    $(document).on('click', '.add-timeline-item', function() {
        var $timeline = $(this).closest('.timeline');
        var $item = $(this).closest('.timeline-item');
        var sectionId = $timeline.find('.editable-field').data('id');
        var index = $item.index();
        var $referenceItem = $item; // Fix: Copy from the current item

        var newDate = $referenceItem.find('.timeline-date').html() || 'New Date';
        var newDescription = $referenceItem.find('p').html() || 'New Description';
        var newIndex = index + 1;

        // Insert new timeline item
        var $newItem = $(`
            <div class="timeline-item">
                <div contenteditable="true" class="editable-field timeline-date" data-model="section" data-id="${sectionId}" data-field="timeline.${newIndex}.date">${newDate}</div>
                <p contenteditable="true" class="editable-field" data-model="section" data-id="${sectionId}" data-field="timeline.${newIndex}.description">${newDescription}</p>
                <span class="timeline-actions">
                    <i class="fas fa-plus add-timeline-item" title="Add Timeline Item"></i>
                    <i class="fas fa-trash remove-timeline-item" title="Remove Timeline Item"></i>
                </span>
            </div>
        `);
        $newItem.find('.editable-field').each(function() {
            $(this).data('last-value', $(this).html()); // Fix: Set initial last-value for new fields
        });
        $item.after($newItem);

        // Update backend
        updateTimeline($timeline);
    });

    // Remove timeline item
    $(document).on('click', '.remove-timeline-item', function() {
        var $timeline = $(this).closest('.timeline');
        var $item = $(this).closest('.timeline-item');
        var count = $timeline.find('.timeline-item').length;

        if (count <= 1) {
            alert('Cannot remove the last timeline item.');
            return;
        }

        $item.remove();
        updateTimeline($timeline);
    });

    // Update list in backend
    function updateList($list) {
        var sectionId = $list.data('id');
        var field = $list.data('field');
        var items = [];
        $list.find('.list-item .editable-field').each(function() {
            items.push($(this).html());
        });

        $.ajax({
            url: '/proposal/update-field',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                _token: $('meta[name="csrf-token"]').attr('content'),
                model: 'section',
                id: sectionId,
                field: field,
                value: items
            }),
            success: function(response) {
                console.log('List updated:', response);
                // Reindex data-field attributes
                $list.find('.list-item').each(function(index) {
                    $(this).find('.editable-field').attr('data-field', `${field}.${index}`);
                });
            },
            error: function(xhr) {
                console.error('List update failed:', xhr);
                alert('Failed to save list: ' + (xhr.responseJSON?.error || 'Unknown error'));
            }
        });
    }

    // Update table in backend
    function updateTable($table) {
        var sectionId = $table.data('id');
        var field = $table.data('field');
        var rows = [];
        $table.find('.table-row').each(function() {
            var $cells = $(this).find('td.editable-field');
            rows.push({
                functionality: $cells.eq(0).html(),
                frontend_price: $cells.eq(1).html(),
                backend_price: $cells.eq(2).html(),
                note: $cells.eq(3).html()
            });
        });

        $.ajax({
            url: '/proposal/update-field',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                _token: $('meta[name="csrf-token"]').attr('content'),
                model: 'section',
                id: sectionId,
                field: field,
                value: rows
            }),
            success: function(response) {
                console.log('Table updated:', response);
                // Reindex data-field attributes
                $table.find('.table-row').each(function(index) {
                    var $cells = $(this).find('.editable-field');
                    $cells.eq(0).attr('data-field', `${field}.${index}.functionality`);
                    $cells.eq(1).attr('data-field', `${field}.${index}.frontend_price`);
                    $cells.eq(2).attr('data-field', `${field}.${index}.backend_price`);
                    $cells.eq(3).attr('data-field', `${field}.${index}.note`);
                });
            },
            error: function(xhr) {
                console.error('Table update failed:', xhr);
                alert('Failed to save table: ' + (xhr.responseJSON?.error || 'Unknown error'));
            }
        });
    }

    // Update timeline in backend
    function updateTimeline($timeline) {
        var sectionId = $timeline.find('.editable-field').first().data('id');
        var field = 'timeline';
        var items = [];
        $timeline.find('.timeline-item').each(function() {
            items.push({
                date: $(this).find('.timeline-date').html(),
                description: $(this).find('p.editable-field').html()
            });
        });

        $.ajax({
            url: '/proposal/update-field',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                _token: $('meta[name="csrf-token"]').attr('content'),
                model: 'section',
                id: sectionId,
                field: field,
                value: items
            }),
            success: function(response) {
                console.log('Timeline updated:', response);
                // Reindex data-field attributes
                $timeline.find('.timeline-item').each(function(index) {
                    $(this).find('.timeline-date').attr('data-field', `timeline.${index}.date`);
                    $(this).find('p.editable-field').attr('data-field', `timeline.${index}.description`);
                });
            },
            error: function(xhr) {
                console.error('Timeline update failed:', xhr);
                alert('Failed to save timeline: ' + (xhr.responseJSON?.error || 'Unknown error'));
            }
        });
    }

    // Keyboard shortcuts
    $(document).on('keydown', function(e) {
        var $activeElement = $(document.activeElement);

        // --- MS Word Style Shortcuts ---

        // Enter to add a new list item
        if (e.key === 'Enter' && !e.shiftKey) {
            var $listItem = $activeElement.closest('.list-item');
            if ($listItem.length) {
                e.preventDefault();
                $listItem.find('.add-item').click();
                $listItem.next().find('.editable-field').focus();
                return;
            }
        }

        // Backspace to remove an empty list item
        if (e.key === 'Backspace') {
            var $listItem = $activeElement.closest('.list-item');
            if ($listItem.length && $activeElement.text().trim() === '' && isCursorAtStart($activeElement[0])) {
                e.preventDefault();
                var $prevItem = $listItem.prev();
                $listItem.find('.remove-item').click();
                if ($prevItem.length) {
                    $prevItem.find('.editable-field').focus();
                }
                return;
            }
        }

        // Ctrl+B for Bold, Ctrl+I for Italic, Ctrl+U for Underline
        if (e.ctrlKey) {
            if (e.key === 'b') { e.preventDefault(); document.execCommand('bold'); return; }
            if (e.key === 'i') { e.preventDefault(); document.execCommand('italic'); return; }
            if (e.key === 'u') { e.preventDefault(); document.execCommand('underline'); return; }
        }

        // --- Arrow Key Navigation ---
        var $listItem = $activeElement.closest('.list-item');
        var $tableCell = $activeElement.closest('td');
        var $timelineItem = $activeElement.closest('.timeline-item');

        if (e.key === 'ArrowDown') {
            if (isCursorAtEnd($activeElement[0])) {
                e.preventDefault();
                if ($listItem.length) {
                    $listItem.next().find('.editable-field').focus();
                } else if ($timelineItem.length) {
                    $timelineItem.next().find('.editable-field').first().focus();
                } else if ($tableCell.length) {
                    var colIndex = $tableCell.index();
                    var $nextRow = $tableCell.closest('tr').next();
                    if ($nextRow.length) {
                        $nextRow.find('td').eq(colIndex).focus();
                    }
                }
            }
        }

        if (e.key === 'ArrowUp') {
            if (isCursorAtStart($activeElement[0])) {
                e.preventDefault();
                if ($listItem.length) {
                    $listItem.prev().find('.editable-field').focus();
                } else if ($timelineItem.length) {
                    $timelineItem.prev().find('.editable-field').first().focus();
                } else if ($tableCell.length) {
                    var colIndex = $tableCell.index();
                    var $prevRow = $tableCell.closest('tr').prev();
                    if ($prevRow.length) {
                        $prevRow.find('td').eq(colIndex).focus();
                    }
                }
            }
        }

        if (e.key === 'ArrowLeft') {
            if (isCursorAtStart($activeElement[0])) {
                if ($tableCell.length) {
                    e.preventDefault();
                    $tableCell.prev().focus();
                }
            }
        }

        if (e.key === 'ArrowRight') {
            if (isCursorAtEnd($activeElement[0])) {
                if ($tableCell.length) {
                    e.preventDefault();
                    $tableCell.next().focus();
                }
            }
        }

        // --- Original Ctrl Key shortcuts ---
        if (e.ctrlKey) {
            var $ctrlListItem = $activeElement.closest('.list-item');
            var $ctrlTableRow = $activeElement.closest('.table-row');
            var $ctrlTimelineItem = $activeElement.closest('.timeline-item');

            // Ctrl + Delete
            if (e.key === 'Delete') {
                e.preventDefault();
                if ($ctrlListItem.length) {
                    const $prevItem = $ctrlListItem.prev();
                    $ctrlListItem.find('.remove-item').click();
                    if ($prevItem.length) {
                        $prevItem.find('.editable-field').focus();
                    }
                } else if ($ctrlTableRow.length) {
                    const $prevRow = $ctrlTableRow.prev();
                    const $table = $ctrlTableRow.closest('.editable-table');
                    $ctrlTableRow.remove();
                    updateTable($table);
                    if ($prevRow.length) {
                        $prevRow.find('.editable-field').first().focus();
                    }
                } else if ($ctrlTimelineItem.length) {
                    const $prevItem = $ctrlTimelineItem.prev();
                    $ctrlTimelineItem.find('.remove-timeline-item').click();
                    if ($prevItem.length) {
                        $prevItem.find('.editable-field').first().focus();
                    }
                }
            }

            // Ctrl + ArrowDown
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if ($ctrlListItem.length) {
                    $ctrlListItem.find('.add-item').click();
                    $ctrlListItem.next().find('.editable-field').focus();
                } else if ($ctrlTableRow.length) {
                    var $table = $ctrlTableRow.closest('.editable-table');
                    var $newRow = $ctrlTableRow.clone();
                    $newRow.find('td.editable-field').html(''); // Clear content
                    $ctrlTableRow.after($newRow);
                    updateTable($table);
                    $newRow.find('td.editable-field').first().focus();
                } else if ($ctrlTimelineItem.length) {
                    $ctrlTimelineItem.find('.add-timeline-item').click();
                    $ctrlTimelineItem.next().find('.editable-field').first().focus();
                }
            }

            // Ctrl + ArrowUp
            if (e.key === 'ArrowUp') {
                e.preventDefault();
                if ($ctrlListItem.length) {
                    var $list = $ctrlListItem.closest('.editable-list');
                    var $newItem = $ctrlListItem.clone();
                    $newItem.find('.editable-field').html('New Item');
                    $ctrlListItem.before($newItem);
                    updateList($list);
                    $newItem.find('.editable-field').focus();
                } else if ($ctrlTableRow.length) {
                    var $table = $ctrlTableRow.closest('.editable-table');
                    var $newRow = $ctrlTableRow.clone();
                    $newRow.find('.editable-field').html('');
                    $ctrlTableRow.before($newRow);
                    updateTable($table);
                    $newRow.find('.editable-field').first().focus();
                } else if ($ctrlTimelineItem.length) {
                    var $timeline = $ctrlTimelineItem.closest('.timeline');
                    var $newItem = $ctrlTimelineItem.clone();
                    $newItem.find('.editable-field').html('New Item');
                    $timelineItem.before($newItem);
                    updateTimeline($timeline);
                    $newItem.find('.editable-field').first().focus();
                }
            }
        }
    });

    function getCursorPosition(element) {
        var selection = window.getSelection();
        if (selection.rangeCount === 0) return 0;
        var range = selection.getRangeAt(0);
        var preCaretRange = range.cloneRange();
        preCaretRange.selectNodeContents(element);
        preCaretRange.setEnd(range.endContainer, range.endOffset);
        return preCaretRange.toString().length;
    }

    function isCursorAtStart(element) {
        if (element.textContent.length === 0) return true;
        return getCursorPosition(element) === 0;
    }

    function isCursorAtEnd(element) {
        if (element.textContent.length === 0) return true;
        var selection = window.getSelection();
        if (selection.rangeCount === 0) return false;
        var range = selection.getRangeAt(0);
        var preCaretRange = range.cloneRange();
        preCaretRange.selectNodeContents(element);
        preCaretRange.setEnd(range.endContainer, range.endOffset);
        return preCaretRange.toString().length === element.textContent.length;
    }
});
