let memberIndex = 1;

document.getElementById('addMemberBtn').addEventListener('click', function () {
    const membersContainer = document.getElementById('membersContainer');

    const memberRow = document.createElement('div');
    memberRow.className = 'd-flex gap-2 mb-2';
    memberRow.innerHTML = `
                        <input type="text" name="members[${memberIndex}][name]" class="form-control" placeholder="نام عضو" required>
                        <input type="text" name="members[${memberIndex}][role]" class="form-control" placeholder="مسئولیت عضو" required>
                        <button type="button" class="btn btn-danger remove-member">حذف</button>
        `;
    membersContainer.appendChild(memberRow);
    memberIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-member')) {
        e.target.parentElement.remove();
    }
});
