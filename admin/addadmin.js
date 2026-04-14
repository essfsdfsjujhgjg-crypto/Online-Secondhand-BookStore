async function fetchTotalAdmins() {
    try {
        const response = await fetch('countadmin.php'); 
        const data = await response.json(); 
        return data.totalAdmins;
    } catch (error) {
        console.error('Error fetching total admins:', error);
        return 0; 
    }
}

async function updateTotalAdmins() {
    const totalAdminsElement = document.getElementById('totalAdmins');
    
    const totalAdmins = await fetchTotalAdmins();

    totalAdminsElement.textContent = totalAdmins;
}

updateTotalAdmins();
