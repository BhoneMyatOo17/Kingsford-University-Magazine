<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Email validation
    const emailInput = document.getElementById('email');
    if (emailInput) {
      const checking = document.getElementById('icon-checking');
      const valid = document.getElementById('icon-valid');
      const invalid = document.getElementById('icon-invalid');
      const msg = document.getElementById('msg');
      let timer;

      emailInput.addEventListener('input', function () {
        clearTimeout(timer);
        checking.classList.add('hidden');
        valid.classList.add('hidden');
        invalid.classList.add('hidden');
        msg.innerHTML = '';
        this.style.border = '1px solid #d1d5db';
        const email = this.value.trim();
        if (!email) return;
        checking.classList.remove('hidden');
        timer = setTimeout(() => {
          if (!email.endsWith('@ksf.it.com')) {
            checking.classList.add('hidden');
            invalid.classList.remove('hidden');
            msg.innerHTML = '<span style="color: #ef4444;">Please use your student email</span>';
            emailInput.style.border = '2px solid #ef4444';
            return;
          }
          fetch('/api/check-email', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ email })
          })
            .then(r => r.json())
            .then(data => {
              checking.classList.add('hidden');
              if (data.exists) {
                invalid.classList.remove('hidden');
                msg.innerHTML = '<span style="color: #ef4444;">Email already registered</span>';
                emailInput.style.border = '2px solid #ef4444';
              } else {
                valid.classList.remove('hidden');
                emailInput.style.border = '2px solid #22c55e';
              }
            })
            .catch(() => {
              checking.classList.add('hidden');
              valid.classList.remove('hidden');
              emailInput.style.border = '2px solid #22c55e';
            });
        }, 500);
      });
    }

    // Faculty → Program → Study Level cascade
    const facultySelect = document.getElementById('faculty_id');
    const programSelect = document.getElementById('program_id');
    const levelSelect = document.getElementById('study_level');

    if (facultySelect && programSelect && levelSelect) {
      const allOptions = programSelect.querySelectorAll('.program-option');
      const allLevelOptions = levelSelect.querySelectorAll('option[value]');

      function updateLevelOptions(level) {
        allLevelOptions.forEach(opt => {
          if (!level) {
            opt.style.display = '';
            opt.disabled = false;
          } else if (opt.value === level) {
            opt.style.display = '';
            opt.disabled = false;
          } else {
            opt.style.display = 'none';
            opt.disabled = true;
          }
        });
        levelSelect.value = level || '';
      }

      facultySelect.addEventListener('change', function () {
        const facultyId = this.value;
        programSelect.value = '';
        updateLevelOptions('');
        allOptions.forEach(opt => {
          const show = opt.dataset.faculty === facultyId;
          opt.style.display = show ? '' : 'none';
          opt.disabled = !show;
        });
      });

      programSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const level = (selected && selected.dataset.level) ? selected.dataset.level : '';
        updateLevelOptions(level);
      });

      @if(old('faculty_id'))
        facultySelect.value = '{{ old('faculty_id') }}';
        facultySelect.dispatchEvent(new Event('change'));
        @if(old('program_id'))
          programSelect.value = '{{ old('program_id') }}';
          programSelect.dispatchEvent(new Event('change'));
        @endif
      @endif
  }

    // Modal
    const modal = document.getElementById('modal');
    const checkbox = document.getElementById('terms');
    const agreeBtn = document.getElementById('agree');
    const content = document.getElementById('content');
    const hint = document.getElementById('hint');

    if (modal && checkbox && agreeBtn) {
      checkbox.addEventListener('change', function () {
        if (this.checked) { modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
      });

      window.closeModal = function () {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        checkbox.checked = false;
      };

      agreeBtn.addEventListener('click', function () {
        checkbox.checked = true;
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
      });

      content.addEventListener('scroll', function () {
        if (this.scrollTop + this.clientHeight >= this.scrollHeight - 5) {
          agreeBtn.disabled = false;
          hint.classList.add('hidden');
        }
      });
    }
  });
</script>