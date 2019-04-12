(() => {
    let chart = null;

    const createTableSalary = (salaries, totalEmployees) => {
        const hourlyEarnings = [
            "unter 8.84 €/Std.",
            "bis 11.50 €/Std.",
            "bis 14.37 €/Std.",
            "bis 17.24 €/Std.",
            "bis 20.1 €/Std.",
            "bis 22.99 €/Std.",
            "bis 25.43 €/Std.",
            "bis 28.74 €/Std.",
            "bis 31.61 €/Std.",
            "bis 34.48 €/Std.",
            "bis 37.36 €/Std.",
            "über 37.36 €/Std.",
        ];
       
        salaries.forEach((salary, index) => {
            const inPercent = ooUtils.computePercentage(totalEmployees, salary[1]);

            document.getElementById("salaryTable").insertAdjacentHTML(
            "beforeend", 
            `<tr class="salary-group">
                <td>${salary[0]}€</td>
                <td>${salary[1]}</td>
                <td>${inPercent}</td>
                <td>${hourlyEarnings[index]}</td>
                <td>${salary[1]}</td>
                <td>${inPercent}</td>
            </tr>`);
        });
    };
    
    const createBenefitsTable = (benefits) => { 
        benefits.forEach((benefit) => {
            const average 
                = (parseFloat(benefit[2], 10) + parseFloat(benefit[3], 10)) / 2;
            document.getElementById("benefitsTable").insertAdjacentHTML(
                "beforeend",
                `<tr class="benefit">
                    <td>${benefit[0]}</td>
                    <td>${benefit[1]}</td>
                    <td>${benefit[2]} €</td>
                    <td>${benefit[3]} €</td>
                    <td>${average.toFixed(2)} €</td>
                </tr>`
            );
        });
    };
    
    const createHourlySalariesTable = (salaries) => { 
        salaries.forEach((salary) => {
            document.getElementById("hourlySalariesTable").insertAdjacentHTML(
                "beforeend",
                `<tr class="benefit">
                    <td>${salary[0]}</td>
                    <td>${salary[1]}</td>
                </tr>`
            );
        });
    };
    
    const setUpChart = (table, chartTitle) => {
        const createChart = (labels, data, backgroundColor, titleText = "Darstellung als Diagramm") => {
            if (chart) {
                chart.destroy(); // Otherwise prior instances of chart want be removed somehow. And then they cause weird behaviour.
            }
    
            chart = new Chart(document.getElementById("doughnutChart"), {
                type: 'doughnut',
                data: {
                  labels,
                  datasets: [{
                    backgroundColor,
                    data
                  }]
                },
                options: {
                  title: {
                    display: true,
                    text: titleText
                  }
                }
            });
        };
    
        const mapFirstTwoColumns = (table) => {
            const columns = { first: [], second: [] };
    
            for (let i = 0; i < table.length; i++) {
                columns.first.push(table[i][0]);
                columns.second.push(table[i][1]);
            }
    
            return columns;
        };

        const columns = mapFirstTwoColumns(table);

        createChart(columns.first, columns.second, 
                        ooUtils.createRandomColors(columns.first.length),
                        chartTitle);
    };

    const switchChart = (idCurrent = "") => {
        switch (idCurrent) {   
            case "benefits":
                setUpChart(benefitsTruncated, "Monatliche brutto Zulagen und Zuschläge");
                break;
            case "hourlySalaries":
                setUpChart(hourlySalariesTruncated, "Stundenlöhne");
                break;
            default:
                setUpChart(salariesTruncated, "Löhne und Gehälter");
                break;
        }
    };
    
    const salariesTruncated = ooData.salaries.slice(1);
    createTableSalary(salariesTruncated, ooUtils.computeSum(salariesTruncated));
    
    const benefitsTruncated = ooData.salaryBenefits.slice(1);
    createBenefitsTable(benefitsTruncated);
    
    const hourlySalariesTruncated = ooData.hourlySalaries.slice(1);
    createHourlySalariesTable(hourlySalariesTruncated);
    
    document.querySelectorAll("[name=diagramSelection]").forEach((radioButton) => {
        radioButton.addEventListener("change", (event) => {
            switchChart(event.target.id);
        });
    });
    
    switchChart();
})();
