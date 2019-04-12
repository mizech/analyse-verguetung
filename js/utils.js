const ooUtils = {};

ooUtils.computeSum = (salaries) => {
    return salaries.reduce((sum, current) => {
        return sum + parseInt(current[1], 10);
    }, 0);
};

ooUtils.computePercentage = (total, subSet)  => {
    return ((subSet * 100) / total).toFixed(1);
};

ooUtils.createRandomColors = (times) => {
    const createColor = () => Math.floor(Math.random() * 256);
    const randomColors = [];
    
    for (let i = 0; i < times; i++) {
        const randomColor =
            `rgb(${createColor()}, ${createColor()}, ${createColor()})`;

        randomColors.push(randomColor);
    }

    return randomColors;
};