import {
  FaBlog,
  FaUser,
  FaProjectDiagram,
  FaQuestionCircle,
  FaQuoteRight,
  FaCog,
  FaSlidersH,
} from "react-icons/fa";
export default [
  {
    label: "Total Users",
    url: "http://localhost/cms/dashboard/api/usersApi/getUsers.php",
    Icon: FaUser,
  },
  {
    label: "Total Blogs",
    url: "http://localhost/cms/dashboard/api/blogApi/getBlog.php",
    Icon: FaBlog,
  },
  {
    label: "Total Portfolio",
    url: "http://localhost/cms/dashboard/api/portfolioApi/getPortfolio.php",
    Icon: FaProjectDiagram,
  },
  {
    label: "Total FAQ",
    url: "http://localhost/cms/dashboard/api/faqAPI/getFaq.php",
    Icon: FaQuestionCircle,
  },
  {
    label: "Total Slider",
    url: "http://localhost/cms/dashboard/api/sliderApi/getSlider.php",
    Icon: FaSlidersH,
  },
  {
    label: "Total Testimonial",
    url: "http://localhost/cms/dashboard/api/testimonyApi/getTestimony.php",
    Icon: FaQuoteRight,
  },
  {
    label: "Total SiteConfig",
    url: "http://localhost/cms/dashboard/api/siteConfigApi/getSiteConfig.php",
    Icon: FaCog,
  },
  {
    label: "Total Social",
    url: "http://localhost/cms/dashboard/api/socialApi/getSocial.php",
    Icon: FaCog,
  },
  {
    label: "Total Services",
    url: "http://localhost/cms/dashboard/api/serviceApi/getService.php",
    Icon: FaCog,
  },
];
