<script type="text/javascript">
    let currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form ...
        let x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n === 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n === (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = 'Submit';
        } else {
            document.getElementById("nextBtn").innerHTML = 'Next';
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        let x = document.getElementsByClassName("tab");

        // Exit the function if any field in the current tab is invalid:
        if (n === 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    // Defining a function to display error message
    function printError(elemId, hintMsg) {
        document.getElementById(elemId).innerHTML = hintMsg;
    }

    // Defining a function to validate form
    function validateForm() {
        // Retrieving the values of form elements
        let name = document.getElementById("name").value;
        let age = document.getElementById("age").value;
        let sex = document.getElementById("sex").value;
        let nationality = document.getElementById("nationality").value;
        let IdType = document.getElementById("id_type").value;
        let IdNo = document.getElementById("identification_number").value;
        let transportMeans = document.getElementById("transport_means").value;
        let vessel = document.getElementById("vessel").value;
        let arrivalDate = document.getElementById("arrival_date").value;
        let pointOfEntry = document.getElementById("point_of_entry").value;
        let stayDuration = document.getElementById("duration_stay").value;
        let employment = document.getElementById("employment").value;
        let regionOrigin = document.getElementById("region_origin").value;

        let region = document.getElementById("region_id").value;
        let mobile = document.getElementById("mobile").value;

        let symptoms = document.getElementsByName("symptoms[]");

        //validate per current tab
        //tab 1 validation
        if (currentTab === 0) {
            let errorName = errorAge = errorSex = errorNationality = errorIdType = errorIdNo = errorTransportMeans = errorVessel = errorArrivalDate = errorPointOfEntry = true;

            // Validate name
            if (name === "") {
                printError("errorName", "<?php echo $this->lang->line('required_full_name'); ?>");
            } else {
                let regex = /^[a-zA-Z\s]+$/;
                if (regex.test(name) === false) {
                    printError("errorName", "<?php echo $this->lang->line('invalid_full_name'); ?>");
                } else {
                    printError("errorName", "");
                    errorName = false;
                }
            }

            //validate age
            if (age === "") {
                printError("errorAge", "<?php echo $this->lang->line('required_age'); ?>");
            } else {
                if (age < 0 || age > 105) {
                    printError("errorAge", "<?php echo $this->lang->line('invalid_age'); ?>");
                } else {
                    printError("errorAge", "");
                    errorAge = false;
                }
            }

            //validate sex
            if (sex === "") {
                printError("errorSex", "<?php echo $this->lang->line('required_sex'); ?>");
            } else {
                printError("errorSex", "");
                errorSex = false;
            }

            //validate nationality
            if (nationality === "") {
                printError("errorNationality", "<?php echo $this->lang->line('required_nationality'); ?>")
            } else {
                printError("errorNationality", "");
                errorNationality = false;
            }

            //id type
            if (IdType === "") {
                printError("errorIdType", "<?php echo $this->lang->line('required_id_type'); ?>")
            } else {
                printError("errorIdType", "");
                errorIdType = false;
            }

            //validate identification
            if (IdNo === "") {
                printError("errorIdNo", "<?php echo $this->lang->line('required_id_no'); ?>")
            } else {
                printError("errorIdNo", "");
                errorIdNo = false;
            }

            //validate transport means
            if (transportMeans === "") {
                printError("errorTransportMeans", "<?php echo $this->lang->line('required_transport_means'); ?>")
            } else {
                printError("errorTransportMeans", "");
                errorTransportMeans = false;
            }

            //validate vessel
            if (vessel === "") {
                printError("errorVessel", "<?php echo $this->lang->line('required_transport_means_name'); ?>")
            } else {
                printError("errorVessel", "");
                errorVessel = false;
            }

            //validate arrivalDate
            if (arrivalDate === "") {
                printError("errorArrivalDate", "<?php echo $this->lang->line('require_arrival_date'); ?>")
            } else {
                let today = new Date();
                //date
                let day = today.getDate();
                day = (day < 10) ? '0' + day : day;

                //month
                let month = today.getMonth() + 1;
                month = (month < 10) ? '0' + month : month;

                //year
                let year = today.getFullYear();
                let currentDate = year + '-' + month + '-' + day;

                if (arrivalDate < currentDate) {
                    printError("errorArrivalDate", "<?php echo $this->lang->line('invalid_arrival_date'); ?>")
                } else {
                    printError("errorArrivalDate", "");
                    errorArrivalDate = false;
                }
            }

            //validate pointOfEntry
            if (pointOfEntry === "") {
                printError("errorPointOfEntry", "<?php echo $this->lang->line('require_point_of_entry'); ?>")
            } else {
                printError("errorPointOfEntry", "");
                errorPointOfEntry = false;
            }

            //check all data in tab one
//            if ((errorName || errorAge || errorSex || errorNationality || errorPassportNo || errorTransportMeans || errorVessel || errorArrivalDate || errorPointOfEntry) === true) {
//                return false;
//            }

            return true;

            //tab 2 validation
        } else if (currentTab === 1) {
            let errorEmployment = errorStayDuration = true;

            //validate duration stay
            if (nationality === 'TZ') {
                printError("errorStayDuration", "");
                errorStayDuration = false;
            } else {
                if (stayDuration === "") {
                    printError("errorStayDuration", "<?php echo $this->lang->line('require_duration_of_stay'); ?>")
                } else {
                    if (stayDuration <= 0) {
                        printError("errorStayDuration", "<?php echo $this->lang->line('invalid_duration_of_stay'); ?>")
                    } else {
                        printError("errorStayDuration", "");
                        errorStayDuration = false;
                    }
                }
            }

            //validate employment
            if (employment === "") {
                printError("errorEmployment", "<?php echo $this->lang->line('required_employment')?>")
            } else {
                printError("errorEmployment", "");
                errorEmployment = false;
            }

            //check all data in tab one
            if ((errorEmployment || errorStayDuration) === true) {
                return false;
            }
            return true;

            //tab 3 validation
        } else if (currentTab === 2) {
            let errorRegion = errorMobile = true;

            //validate region
            if (region === "") {
                printError("errorRegion", "<?php echo $this->lang->line('required_region');?>");
            } else {
                printError("errorRegion", "");
                errorRegion = false;
            }

            //validate mobile
            if (mobile === "") {
                printError("errorMobile", "<?php echo $this->lang->line('required_mobile');?>");
            } else {
                printError("errorMobile", "");
                errorMobile = false;
            }

            //check all data in tab one
//            if ((errorRegion || errorMobile) === true) {
//                return false;
//            }
            return true;

            //tab 3 validation
        } else if (currentTab === 3) {
            let errorRegionOrigin = true;

            if (regionOrigin === "") {
                printError("errorRegionOrigin", "<?php echo $this->lang->line('required_region_journey_started');?>");
            } else {
                printError("errorRegionOrigin", "");
                errorRegionOrigin = false;
            }

            //check all data in tab 3
            if ((errorRegionOrigin) === true) {
                return false;
            }
            return true;

        } else if (currentTab === 4) {
            return true;
        } else if (currentTab === 5) {
            return true;
        } else if (currentTab === 6) {
            return true;
        } else if (currentTab === 7) {
            let errorSymptoms = true;

            for (let i = 0; i < symptoms.length; i++) {
                if (symptoms[i].type === 'checkbox') {
                    if (symptoms[i].checked) {
                        printError("errorSymptoms", "");
                        errorSymptoms = false;
                    } else {
                        printError("errorSymptoms", "<?php echo $this->lang->line('required_symptoms'); ?>");
                    }
                }
            }

            //check all data in tab 3
            if ((errorSymptoms) === true) {
                return false;
            }
            return true;
        }
        return true;
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        let i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }
</script>