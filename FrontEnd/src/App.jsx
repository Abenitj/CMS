import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import User from "./page/User";
import Faq from "./page/Faq";
import Testimonial from "./page/Testimonial";
import SectionTitle from "./page/SectionTitle";
import SiteConfiguration from "./page/SiteConfiguratin";
import Blog from "./page/Blog";
import Slider from "./page/Slider";
import Social from "./page/Social";
import Dashboard from "./page/Dashboard";
import Navbar from "./Components/Navbar";
import Sidebar from "./Components/SideBar";

const App = () => {
  return (
    <Router>
      <div className="flex w-screen h-screen bg-primary fixed">
        {/* Sidebar: Fixed on the left side */}
        <div className="md:w-[19%] transition-all duration-300 ease-in-out h-screen text-nuetral">
          <Sidebar />
        </div>
        {/* Main content area: occupies the rest of the screen */}
        <div className="flex-1 flex flex-col bf-primary">
          {/* Navbar: Fixed at the top of the main content area */}
          <div className="w-full h-[50px] bg-slate-100">
            <Navbar />
          </div>
          {/* Main content: the dashboard's main content area */}
          <main className="flex-1 bg-primary p-4 overflow-y-auto">
            <Routes>
              <Route path="/" element={<Dashboard />} />
              <Route path="/user" element={<User />} />
              <Route path="/faq" element={<Faq />} />
              <Route path="/testimonial" element={<Testimonial />} />
              <Route path="/section-title" element={<SectionTitle />} />
              <Route path="/site-configuration" element={<SiteConfiguration />} />
              <Route path="/blog" element={<Blog />} />
              <Route path="/slider" element={<Slider />} />
              <Route path="/social" element={<Social />} />
            </Routes>
          </main>
        </div>
      </div>
    </Router>
  );
};

export default App;
