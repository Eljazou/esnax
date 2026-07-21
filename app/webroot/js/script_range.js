
	document.addEventListener("DOMContentLoaded", () => {
  const range = document.querySelector('[data-range]');
  const rangeInput = document.querySelector('[data-range-input]');

  showRangeContent(range, rangeInput);
  rangeInput.addEventListener('input', () => showRangeContent(range, rangeInput));
});

function showRangeContent(range, rangeInput) {
  const rangeOption = range.querySelector(`option[value="${rangeInput.value}"]`);
  const { rangeLink } = rangeOption.dataset;
  const rangeContent = document.querySelector(`[data-range-step="${rangeLink}"]`);
  document.querySelectorAll('[data-range-step]').forEach(item => {
    if (item !== rangeContent) {
      item.classList.remove('active');
    } else {
      item.classList.add('active');
    }
  })
}

