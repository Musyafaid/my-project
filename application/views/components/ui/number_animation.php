<script>
    function animateNumber(element, start, end, duration) {
        let startTime = null;

        function animationStep(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = timestamp - startTime;
            const current = Math.min(Math.floor((progress / duration) * (end - start) + start), end);
            
            element.textContent = current.toLocaleString();  
            
            if (current < end) {
                requestAnimationFrame(animationStep);
            }
        }

        requestAnimationFrame(animationStep);
    }

    const element = document.getElementById('animatedNumber');
    const element2 = document.getElementById('animatedNumber2');
    const element_val = parseInt(element.textContent) || 0;  
    const element_val2 = parseInt(element2.textContent) || 0;  
    animateNumber(element, 0, element_val, 500);  
    animateNumber(element2, 0, element_val2, 500);  
</script>

