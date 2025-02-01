document.addEventListener('DOMContentLoaded', function () {
    const membersContainer = document.getElementById('members-container');
    const addMemberBtn = document.getElementById('add-member-btn');

    addMemberBtn.addEventListener('click', () => {
        const memberIndex = membersContainer.children.length;
        const memberRow = document.createElement('div');
        memberRow.classList.add('d-flex', 'gap-2', 'mb-2', 'member-row');
        memberRow.innerHTML = `
                    <input type="text" name="members[${memberIndex}][name]" class="form-control" placeholder="نام عضو" required>
                    <input type="text" name="members[${memberIndex}][role]" class="form-control" placeholder="مسئولیت" required>
                    <button type="button" class="btn btn-danger remove-member">حذف</button>
                `;
        membersContainer.appendChild(memberRow);
    });

    membersContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove-member')) {
            event.target.closest('.member-row').remove();
        }
    });
});
